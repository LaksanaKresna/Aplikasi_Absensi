<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaceRecognitionRequest;
use App\Models\Attandance;
use App\Models\AttandanceStatus;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use PDF;

class AttandanceController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        extract(request()->query());
        $Att = Attandance::get();
        if ((@$date1 && @$date2) ?? false) {
            $Att = $Att->whereBetween('att_date', [$date1, $date2]);
        }
        if ($employee ?? false) {
            $Att = $Att->where('employee_id', $employee);
        }
        $Att = $Att->take(100);
        $employees = Employee::orderBy('name', 'ASC')->get();
        if (Gate::allows('isEmployee')) {
            $employees = $employees->where('id', auth()->user()->employee_id);
            $Att = $Att->where('employee_id', auth()->user()->employee_id);
        }
        if ($is_pdf ?? false) {
            $pdf = PDF::loadview('admin/attandance/employee_pdf', ['attandances' => $Att]);
            return $pdf->stream();
        }

        return view('admin/attandance/index', [
            'title' => 'Attandances',
            'active' => 'attandance',
            'page' => 'Attandances',
            'attandances' => $Att,
            'employees' => $employees,


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $label = $request->label;
        $employee = Employee::where('nik', $label)->first();
        return view('admin/attandance/create', [
            'title' => 'Add New Attandance',
            'employee' => $employee,
            'button_name' => 'Save',

        ]);
    }
    public function createAdmin()
    {
        $employee = Employee::orderBy('name', 'asc')->get();
        $attandancestatuses = AttandanceStatus::whereNotIn('id', [5])->get();
        return view('admin/attandance/create_admin', [
            'title' => 'Add New Attandance',
            'active' => 'attandance',
            'page' => 'Add New Attandance',
            'attandance' => new Attandance(),
            'employees' =>  $employee,
            'attandancestatuses' =>  $attandancestatuses,
            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaceRecognitionRequest $request)
    {
        $employee = Employee::find($request->employee_id);

        if (Hash::check($request->pin, $employee->pin)) {
            $attandancestatus_id = $request->type;
            $dataSend = [
                'employee_id' => $employee->id,
                'att_date' => date('Y-m-d'),
                'attandancestatus_id' => $attandancestatus_id,
                'lat' => $request->lat,
                'lng' => $request->lng,

            ];
            $Att = Attandance::where(['att_date' => date('Y-m-d'), 'employee_id' => $employee->id]);
            $cekAtt = $Att->exists();
            $targetMsg = "";
            // jika izin bisa kasih note
            if ($attandancestatus_id == 2) { //izin
                $targetMsg = "Permission";
                $dataSend['notes'] = $request->notes;
                if ($cekAtt) {
                    return back()->with('success', "You're Absent/Permission, Permission Denied..!");
                }
            }
            if ($attandancestatus_id == 5) { //klau hadir tambahkan nilai jam masuk dan pulangnya
                $targetMsg = "Morning Absence";
                // cek kalo absennya sudah ada balikin aja
                if ($request->typeabsen == 'masuk') {
                    if ($cekAtt) {
                        return back()->with('success', 'You Have Absent Morning / Permission..!');
                    }
                    $dataSend['att_in'] = now();
                    $absennya = $dataSend['att_in'];
                    $batasterlambat = batasTerlambat();
                    $late_time = \Carbon\Carbon::parse($absennya)->diffInSeconds($batasterlambat);
                    if ($absennya > $batasterlambat) {

                        $notes = "Terlambat : " . $late_time . " detik";
                        $late = 1;
                    } else {
                        $notes = "Datang Lebih Awal : " . $late_time . " detik";
                        $late = 0;
                    }
                    $dataSend['is_late'] = $late;
                    $dataSend['in_notes'] = $notes;
                    $dataSend['late_time'] = $late_time;
                } else if ($request->typeabsen == 'pulang') {
                    if (!$cekAtt) {
                        return back()->with('success', 'You have not been absent in the morning..!');
                    }
                    $attAttr = $Att->first();
                    if ($attAttr->attandancestatus_id != 5) { //bukan absen maka gabisa absen pulang
                        return back()->with('success', 'Failed, you are not registered absent today, Maybe you have done permission..!');
                    }
                    // pulang
                    $absenpulang = now();
                    $bataspulang = batasPulang();
                    $early_time = \Carbon\Carbon::parse($absenpulang)->diffInSeconds($bataspulang);
                    if ($absenpulang < $bataspulang) {
                        $early = 1;
                        $notes = "Pulang Lebih Awal : " . $early_time . " detik dari jam pulang";
                    } else {
                        $early = 0;
                        $notes = "Pulang Tepat Waktu : Lebih " . $early_time . " detik dari jam pulang";
                    }
                    $Att->update(['att_out' => $absenpulang, 'out_notes' => $notes, 'is_early' => $early, 'early_time' => $early_time]);
                    return back()->with('success', 'Successfully Absent Afternoon..!');
                } else {
                    return back()->with('success', 'Error...!');
                }
            }
            // The pin match...
            $distance = countDistanceRadius(
                $request->lat,
                $request->lng
            );
            if ($distance->count() > 0) {
                $getDistance = $distance->first()->distance;
                $dataSend['distance'] = round($getDistance, 2);
            }

            Attandance::create($dataSend);
            return back()->with('success', "Successfully Doing $targetMsg ..!");
        }


        return back()->with('success', 'Failed to be absent..!');
    }

    public function storeAdmin(Request $request)
    {
        $cekAtt = Attandance::where(['att_date' => $request->att_date, 'employee_id' => $request->employee_id])->exists();
        if ($cekAtt) {
            return back()->with('success', 'Attandance record already exists..');
        }
        Attandance::create($request->only(['employee_id', 'notes', 'attandancestatus_id', 'att_date']));
        return redirect('attandance')->with('success', "Successfully Added New Attandance");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attandance  $attandance
     * @return \Illuminate\Http\Response
     */
    public function show(Attandance $attandance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attandance  $attandance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attandance $attandance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attandance  $attandance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attandance $attandance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attandance  $attandance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attandance $attandance)
    {
        $attandance->delete();
        return redirect('attandance')->with('success', 'Successfully delete attandance');
    }
}

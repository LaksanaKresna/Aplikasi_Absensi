<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFaceRequest;
use App\Models\Employee;
use App\Models\EmployeeFace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeFaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin/employeeface/create', [
            'title' => 'Add New Employee Face',
            'active' => 'employee',
            'page' => 'Add New Employee Face',
            'employee' => new EmployeeFace(),

            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeFaceRequest $request)
    {
        if ($request->ajax()) {

            // dd($request);
            $dtnya = $request->only('employee_id');
            $employee = Employee::find($request->employee_id);
            $folderNik = $employee->nik;
            if ($request->hasFile('file')) {

                //cek di database hitung total face si user klo ga ada hitung dr satu
                $count = EmployeeFace::where('employee_id', $request->employee_id)->count() + 1;
                $filename = $count . '.png';
                $path = $request->file('file')->storeAs("public/faces/$folderNik", $filename);


                $dtnya['face'] = $path;
            }

            EmployeeFace::create($dtnya);
            return response()->json([
                'status' => 'success',
                'msg' => 'Successfully added new face',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeFace  $employeeFace
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeFace $employeeFace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeFace  $employeeFace
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeFace $employeeFace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeFace  $employeeFace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeFace $employeeFace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeFace  $employeeFace
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeFace $employeeface)
    {
        if (Storage::exists($employeeface->face)) {
            Storage::delete($employeeface->face);
        }
        $employeeface->delete();
        return back()->with('success', 'Successfully delete face');
    }
}

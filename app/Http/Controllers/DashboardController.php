<?php

namespace App\Http\Controllers;

use App\Models\Attandance;
use App\Models\AttandanceStatus;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $dataAttChat = [];
        $attStatus = AttandanceStatus::get(['id', 'name']);
        $bgData = [
            "Izin" => "#4B49AC",
            "Hadir" => "#42f5b3",
            "Cuti" => "#f5d142",
            "Alpa" => "#f54254",
        ];
        // return $bgData;
        foreach ($attStatus as $dt) {
            $statusId = $dt->id;
            $statusName = $dt->name;
            // ambil bulannya
            $months = Attandance::join('attandance_statuses', 'attandances.attandancestatus_id', '=', 'attandance_statuses.id')
                ->select(DB::raw("Month(attandances.created_at) as month"))
                ->whereYear('attandances.created_at', date('Y'))->where(['attandances.attandancestatus_id' => $statusId])
                ->groupBy(DB::raw("Month(attandances.created_at)"))
                ->pluck('month');
            // ambil trxnya
            $trx = Attandance::join('attandance_statuses', 'attandances.attandancestatus_id', '=', 'attandance_statuses.id')
                ->select(DB::raw('count(attandances.id) as count'))
                ->whereYear('attandances.created_at', date('Y'))->where(['attandances.attandancestatus_id' => $statusId])
                ->groupBy(DB::raw("Month(attandances.created_at)"))
                ->pluck('count');

            $datas = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            foreach ($months as $index => $month) {
                $datas[$month - 1] = (int)$trx[$index];
            }
            $dataAttChat[] = ['name' => $statusName, 'data' => $datas, 'color' => $bgData[$statusName]];
        }
        $mostAbsentTop5
            = Attandance::without('employee', 'attandancestatus')->join('attandance_statuses', 'attandances.attandancestatus_id', '=', 'attandance_statuses.id')
            ->join('employees', 'employees.id', '=', 'attandances.employee_id')
            ->select('employees.name', DB::raw('count(attandances.id) as count'))
            ->whereMonth('attandances.created_at', now()->month)->where(['attandances.attandancestatus_id' => 3])
            ->groupBy(DB::raw("employees.name"))->orderBy('count', 'DESC')->take(5)
            ->get();
        // return $mostAbsentTop5;
        $arrChartMostAbsent = [];
        foreach ($mostAbsentTop5 as $v) {
            $arrChartMostAbsent[] = [
                $v->name, (int)$v->count
            ];
        }
        // dd('ok');
        // return $arrChartMostAbsent;
        return view('admin/dashboard/index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'page' => 'Dashboard',
            'breadcrumbs' => collect(['Dashboard']),
            'todayAtt' => Attandance::where(['att_date' => date('Y-m-d'), 'attandancestatus_id' => 5])->count(),
            'todayPermit' => Attandance::where(['att_date' => date('Y-m-d'), 'attandancestatus_id' => 2])->count(),
            'todayOnleave' => Attandance::where(['att_date' => date('Y-m-d'), 'attandancestatus_id' => 4])->count(),
            'totalEmployee' => Employee::where('status_id', 1)->count(),
            'dataAttChat' => $dataAttChat,
            'arrChartMostAbsent' => $arrChartMostAbsent,
        ]);
    }
}

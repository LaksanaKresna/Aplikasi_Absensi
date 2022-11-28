<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        $this->generateJsonFace();
        return view('front/home', [
            'title' => 'Attendance with face recognition',

        ]);
    }

    public function getFace()
    {
        $employeeNames = Employee::withCount('faces')->having('faces_count', '=', 2)->pluck('nik');
        return response()->json($employeeNames);
    }
    public function getFaceID(Request $request)
    {
        $employee = Employee::where('nik', $request->nik)->first();
        return response()->json([
            'identity' => "$employee->name - $employee->nik"
        ]);
    }
    private function generateJsonFace()
    {
        $fileName = 'list.json';
        $test = Employee::pluck('name', 'nik');
        // return $test;
        File::put(public_path('/plugin/faceapi/' . $fileName), $test);
    }
    public function getCekLocation()
    {
        extract(request()->query());
        $jarak = radius();
        $sql = countDistanceRadius($lat, $long);
        if ($sql->count() == 0) {
            $set = setdata()->count_radius;
            $sambung = "";
            if ($set) {
                $sambung = " You can only Permission.";
            }
            return "You are outside a radius of $jarak meters from the office..$sambung";
        }
        $row = $sql->first();
        echo "You are currently in attendance radius " . $row->appname . " with Distance " . round($row->distance, 2) . " meters";
        echo "<br>";
        echo "<p><button id='btnabsen' href='#absen' class='btn btn-success'>Please Absence / Permission Now</button> <p>";
    }
}

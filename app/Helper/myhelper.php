<?php

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

function setdata()
{
    return Setting::find(1);
    // return "";
}
function gender($init)
{
    if ($init == 'L') {
        return "Pria";
    }
    return "Wanita";
}

function setActiveMenu($arr, $msg)
{
    foreach ($arr as $v) {
        $method = "$v*";
        if (Request::is($method)) {
            return $msg;
        }
    }
    return '';
}
function radius()
{
    return 100; //jarak
}
function unitDistance()
{
    return 6371000; //meter
}
function countDistanceRadius($lat, $long)
{
    $satuan = unitDistance();
    $jarak = radius();
    return DB::table('settings')
        ->select('id', 'appname', DB::raw("(
                $satuan * acos (
                cos ( radians($lat) )
                * cos( radians( latitude ) )
                * cos( radians( longtitude ) - radians($long) )
                + sin ( radians($lat) )
                * sin( radians( latitude ) )
                )
            ) AS distance"))
        ->havingRaw('distance <= ?', [$jarak]);
}
function batasTerlambat()
{
    return date('Y-m-d') . " " . setdata()->in_time;
}
function batasPulang()
{
    return date('Y-m-d') . " " . setdata()->out_time;
}

function roleDesc($role)
{
    if ($role == 1) {
        return "Administrator";
    } elseif ($role == 2) {
        return "Employee";
    }
}
function initials($str)
{
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}

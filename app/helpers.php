<?php

use App\Models\Excuse;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

function flash($title=null, $message=null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args()==0) {
        return $flash;
    }
    return $flash->info($title, $message);
}

function getEmployeeID($name)
{
    $staff = Employee::where('name', $name)->first();
    if($staff)
        return $staff->id;

    return null;
}

function getExcuseDateForEmployee($date, $emp_id)
{
    // $excuse = DB::table('excuses')->whereRaw("$date >= from_date AND $date <= to_date")->first();
    $excuse = Excuse::where('emp_id', $emp_id)
    ->where('from_date', '<=', $date)
    ->where('to_date', '>=', $date)
    ->first();
    if($excuse)
        return true;
    return false;
}

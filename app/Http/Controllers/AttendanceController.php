<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;
use App\Models\AttendanceRecord;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //show attendance
    public function index(Request $request)
    {
        if(!empty($request->date_from)){
            // dd($request->all());
            $data['attendances'] = AttendanceRecord::whereBetween('att_date', [$request->date_from, $request->date_to])->orderByDesc('att_date')->get();
        } else {
            $data['attendances'] = [];
        }

        return view('admin.attendance')->with($data); //->with(['attendances' => Attendance::all()]);
    }

    //show late times
    public function indexLatetime()
    {
        return view('admin.latetime')->with(['latetimes' => Latetime::all()]);
    }



    // public static function lateTime(Employee $employee)
    // {
    //     $current_t = new DateTime(date('H:i:s'));
    //     $start_t = new DateTime($employee->schedules->first()->time_in);
    //     $difference = $start_t->diff($current_t)->format('%H:%I:%S');

    //     $latetime = new Latetime();
    //     $latetime->emp_id = $employee->id;
    //     $latetime->duration = $difference;
    //     $latetime->latetime_date = date('Y-m-d');
    //     $latetime->save();
    // }

    public static function lateTimeDevice($att_dateTime, Employee $employee)
    {
        $attendance_time = new DateTime($att_dateTime);
        $checkin = new DateTime($employee->schedules->first()->time_in);
        $difference = $checkin->diff($attendance_time)->format('%H:%I:%S');

        $latetime = new Latetime();
        $latetime->emp_id = $employee->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = date('Y-m-d', strtotime($att_dateTime));
        $latetime->save();
    }

}

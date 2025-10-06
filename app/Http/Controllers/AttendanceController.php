<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;

class AttendanceController extends Controller
{
    //show attendance
    public function index(Request $request)
    {
        if(!empty($request->date_from)){
            if($request->unit === "ALL" && $request->staff_name === "ALL"){
                $data['attendances'] = AttendanceRecord::whereBetween('att_date', [$request->date_from, $request->date_to])->orderByDesc('att_date')->get();
            }
            elseif(is_numeric($request->unit) && $request->staff_name === "ALL"){
                $data['attendances'] = AttendanceRecord::
                        join('schedule_employees', 'attendance_records.employee_id', '=', 'schedule_employees.emp_id')
                        ->select('attendance_records.*')
                        ->where('schedule_employees.schedule_id', '=', $request->unit)
                        ->whereBetween('att_date', [$request->date_from, $request->date_to])->orderByDesc('att_date')
                        ->get();
            }
            elseif($request->unit === "ALL" && strlen($request->staff_name) > 3){
                $employee_id = getEmployeeID($request->staff_name);
                $data['attendances'] = AttendanceRecord::whereBetween('att_date', [$request->date_from, $request->date_to])->orderByDesc('att_date')
                                    ->where('employee_id', $employee_id)->get();
            }
            else{
                $employee_id = getEmployeeID($request->staff_name);
                $data['attendances'] = AttendanceRecord::whereBetween('att_date', [$request->date_from, $request->date_to])->orderByDesc('att_date')
                                    ->where('employee_id', $employee_id)->get();
            }
            // dd($request->all());
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

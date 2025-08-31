<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendanceRecord;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;

class CheckController extends Controller
{
    public function index()
    {
        $data['attendance'] = AttendanceRecord::all()->unique('for_sorting');
        // return view('admin.check')->with(['employees' => Employee::all()]);
        return view('admin.upload_attendance', $data);
    }

    public function CheckStore(Request $request)
    {
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('emp_id'))->first()) {
                        if (
                            !Attendance::whereAttendance_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(0)
                                ->first()
                        ) {
                            $data = new Attendance();

                            $data->emp_id = $key;
                            $emp_req = Employee::whereId($data->emp_id)->first();
                            $data->attendance_time = date('H:i:s', strtotime($emp_req->schedules->first()->time_in));
                            $data->attendance_date = $keys;

                            $emps = date('H:i:s', strtotime($employee->schedules->first()->time_in));
                            if (!($emps > $data->attendance_time)) {
                                $data->status = 0;

                            }
                            $data->save();
                        }
                    }
                }
            }
        }
        if (isset($request->leave)) {
            foreach ($request->leave as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('emp_id'))->first()) {
                        if (
                            !Leave::whereLeave_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(1)
                                ->first()
                        ) {
                            $data = new Leave();
                            $data->emp_id = $key;
                            $emp_req = Employee::whereId($data->emp_id)->first();
                            $data->leave_time = $emp_req->schedules->first()->time_out;
                            $data->leave_date = $keys;
                            if ($employee->schedules->first()->time_out <= $data->leave_time) {
                                $data->status = 1;

                            }

                            $data->save();
                        }
                    }
                }
            }
        }
        flash()->success('Success', 'You have successfully submited the attendance !');
        return back();
    }
    public function sheetReport(Request $request)
    {
        $selectedDate = "$request->year-$request->month-01";

        $today = !empty($request->month) ? Carbon::parse($selectedDate) : today();
        //dd($today, Carbon::parse('2025-01-01'));
        $dates = [];
        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }
        $data['dates'] = $dates;
        $data['header'] = $today->monthName. ', '. $today->year;

        if(!empty($request->month)){
            if($request->staff_name === "ALL"){
                $data['employees'] = Employee::all();
            }
            else{
                $employee_id = getEmployeeID($request->staff_name);
                $data['employees'] = Employee::where('id', $employee_id)->get();
            }
        } else {
            $data['employees'] = [];
        }

        return view('admin.sheet-report')->with($data);

    }

    public function exportAttendanceTemplate()
    {
        return Excel::download(new AttendanceExport(), 'attendance_template.xlsx');
    }

    public function uploadAttendanceRecord(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'description' => 'required|string|max:255',
            'upload_date' => 'required|date',
            'file' => 'required|file|mimes:xlsx,xls,csv|max:1048'
        ]);

        Excel::import(new AttendanceImport($request->description, $request->upload_date), $request->file('file'));

        flash()->success('Success', 'You have successfully uploaded the attendance !');
        return back();
    }

    public function updateAttendanceRecord(Request $request)
    {
        // Validate the request if needed
        $request->validate([
            'description' => 'required|string|max:255',
            'upload_date' => 'required|date',
        ]);

        $for_sorting = AttendanceRecord::find($request->id)->for_sorting;

        AttendanceRecord::where('for_sorting', $for_sorting)->update([
            'description' => $request->description,
            'upload_date' => $request->upload_date,
            'updated_by' => Auth()->user()->id,
        ]);

        flash()->success('Success', 'You have successfully updated the attendance !');
        return back();
    }

    public function attendanceRecordsDelete($for_sorting)
    {
        AttendanceRecord::where('for_sorting', $for_sorting)->delete();

        flash()->success('Success', 'You have successfully deleted the attendance !');
        return back();
    }
}

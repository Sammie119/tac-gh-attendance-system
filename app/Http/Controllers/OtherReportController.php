<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use App\Models\Employee;

class OtherReportController extends Controller
{
    public function otherReport(Request $request)
    {
        if(!empty($request->month)){
            $results = '';
            $date_from = $request->year."-".$request->month."-01";
            $date_to =  date("Y-m-t", strtotime($date_from));

            if($request->report === 'late'){
                $results = AttendanceRecord::whereBetween('att_date', [$date_from, $date_to])->orderByDesc('att_date')->get();
            }
            else {
                // SELECT * FROM Table1 WHERE Table1.principal NOT IN (SELECT principal FROM table2)
                $results = Employee::whereRaw("employees.id NOT IN (SELECT employee_id FROM attendance_records WHERE att_date BETWEEN '$date_from' AND '$date_to')")
                            ->get();
            }

            $data['other_report'] = [
                'report' => $request->report,
                'year' => $request->year,
                'month' => $request->month,
                'data' => $results
            ];
        }

        else $data['other_report'] = [];
        return view('admin.other_report', $data);
    }
}

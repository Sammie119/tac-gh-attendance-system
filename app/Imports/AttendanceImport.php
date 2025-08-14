<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\AttendanceRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AttendanceImport implements ToModel,WithHeadingRow, WithValidation
{
    private string $description;
    private string $upload_date;
    public function __construct(string $description, string $upload_date)
    {
        $this->description = $description;
        $this->upload_date = $upload_date;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private function dateConvertor($date): string
    {
        if(is_int($date)){
            return date("Y-m-d H:i:s", $date);
        }
        return date('Y-m-d H:i:s', strtotime($date));
    }

    private function timeConvertor($time): string
    {
        if(is_int($time)){
            return date("H:i:s", $time);
        }
        return date('H:i:s', strtotime($time));
    }

    private function getEmployeeID($staff_id): int
    {
        return Employee::where('staff_id', $staff_id)->value('id') ?? 0;
    }

    public function model(array $row)
    {
        $forSorting = date('YmdHis');

        return new AttendanceRecord([
            'employee_id' => $this->getEmployeeID($row['employee_id']),
            'description' => $this->description,
            'upload_date' => $this->upload_date,
            'att_date' => $this->dateConvertor($row['att_date']),
            'att_weekday' => $row['att_weekday'],
            'check_in_time' => $this->timeConvertor($row['check_in_time']),
            'check_out_time' => $this->timeConvertor($row['check_out_time']),
            'total_hours' => $row['total_hours'],
            'location' => $row['location'],
            'for_sorting' => $forSorting,
            'created_by' => Auth()->user()->id,
            'updated_by' => Auth()->user()->id,
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'att_date' => 'required|date',
            'att_weekday' => 'required|string|max:255',
            'check_in_time' => 'required|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'total_hours' => 'nullable',
            'location' => 'required|in:Headquarters,Annex-Fafraha',
        ];
    }
}

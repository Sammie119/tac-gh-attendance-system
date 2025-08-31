<?php

namespace App\Http\Controllers;

use App\Models\Excuse;
use Illuminate\Http\Request;

class ExcuseController extends Controller
{

    public function index()
    {
        // getExcuseDateForEmployee('2025-08-25', 115)
        $data['excuses'] = Excuse::orderByDesc('id')->get();
        return view('admin.excuses', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'staff_name' => 'required',
            'excuse_type' => 'required|in:Official-Duty,Leave,Sick,Others',
            'description' => 'required',
            'approved_by_name' => 'required',
            'date_from' => 'required|date|before:date_to',
            'date_to' => 'required|date|after:date_from',
        ]);

        $excuse = Excuse::create([
            'emp_id' => getEmployeeID($request->staff_name),
            'excuse_type' => $request->excuse_type,
            'excuse_description' => $request->description,
            'from_date' => $request->date_from,
            'to_date' => $request->date_to,
            'approved_by_id' => getEmployeeID($request->approved_by_name),
            'created_by' => Auth()->user()->id,
            'updated_by' => Auth()->user()->id,
        ]);

        if($excuse){
            flash()->success('Success', 'You have successfully added an excuse !');
            return back();
        }

        flash()->success('Error', 'Error...!!!');
        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Excuse  $excuse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $excuse)
    {
        $request->validate([
            'staff_name' => 'required',
            'excuse_type' => 'required|in:Official-Duty,Leave,Sick,Others',
            'description' => 'required',
            'approved_by_name' => 'required',
            'date_from' => 'required|date|before:date_to',
            'date_to' => 'required|date|after:date_from',
        ]);

        $excuse = Excuse::find($excuse)->update([
            'emp_id' => getEmployeeID($request->staff_name),
            'excuse_type' => $request->excuse_type,
            'excuse_description' => $request->description,
            'from_date' => $request->date_from,
            'to_date' => $request->date_to,
            'approved_by_id' => getEmployeeID($request->approved_by_name),
            'updated_by' => Auth()->user()->id,
        ]);

        if($excuse){
            flash()->success('Success', 'You have successfully updated an excuse !');
            return back();
        }

        flash()->success('Error', 'Error...!!!');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Excuse  $excuse
     * @return \Illuminate\Http\Response
     */
    public function destroy($excuse)
    {
        $excuse = Excuse::find($excuse);
        if($excuse){
            $excuse->delete();

            flash()->success('Success', 'You have successfully deleted an excuse !');
            return back();
        }

        flash()->success('Error', 'Error...!!!');
        return back();

    }
}

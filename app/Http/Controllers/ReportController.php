<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Department;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Manila");
        //
        $data = $request->all();

        $request->validate([
            'department' => 'required',
            'reported_by' => 'required',
            'problem_reported' => 'required'
        ]);

        $report = new Report();

        $report->department_id = $request->department;
        $report->reported_by = $request->reported_by;
        $report->problem_reported = $request->problem_reported;
        $report->user_id = auth()->user()->id;
        $report->save();

        if($report){
            session()->flash('success_message', 'Report Added!.');
            return redirect()->back();
        }else{
            session()->flash('error_message', 'Data Encounterd Error.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        //return $report;
        $department = Department::get();
        return view('pages.edit-report')->with(['department'=> $department, 'report' => $report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
        $request->validate([
            'department' => 'required',
            'reported_by' => 'required',
            'problem_reported' => 'required',
        ]);

        $rep = Report::where('id',$id)->update([
            'department_id' => $request->department,
            'reported_by' => $request->reported_by,
            'problem_reported' => $request->problem_reported,
            'user_id' => auth()->user()->id,
        ]);
        
        return redirect('tech_report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel($id){
        $cancel = Report::findOrFail($id);

        $update_to_cancel = Report::where('id', $id)->update(['status' => 3]);

        return back(); 
    }
    public function done($id){
        $cancel = Report::findOrFail($id);

        $update_to_cancel = Report::where('id', $id)->update(['status' => 2]);

        return back(); 
    }
    public function retrieve_canceled($id){
        $this->timeZone();
        $retrieve = Report::where('id',$id)->update(['status' => 1, 'updated_at'=> now()]);
        
        if(!$retrieve){
            return "Retrieve Error";
        }
        return redirect()->route('tech_report');

    }
    public function reWork($id){
        $this->timeZone();
        $retrieve = Report::where('id',$id)->update(['status' => 1, 'updated_at'=> now()]);
        if(!$retrieve){
            return "Retrieve Error";
        }
        return redirect()->route('tech_report');
    }
    public function timeZone(){
        return date_default_timezone_set("Asia/Manila");
    }
}

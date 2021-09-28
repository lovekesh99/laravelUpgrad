<?php

namespace App\Http\Controllers\Crm;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $activities = Activity::all();
       return view('crm.activities.index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $lead_id = $id;
        $accounts = Account::all();
        $contacts = Contact::all();
        $activities_status = DB::table('activities_status')->get();
        $priority = DB::table('priority')->get();
        return view('crm.activities.create',compact('lead_id','accounts','contacts','activities_status','priority'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'subject'=>'required'
        ],[
            'subject.required'=>'Subject cannot be empty'
        ]);
       $activities = new Activity();
       $activities->user_id = session('USER_ID');
       $activities->subject = $request->subject;
       $activities->due_date = $request->due_date;
       if($request->account_id!=''){
        $activities->account_id = $request->account_id;
       }elseif($request->account_id=='' && $id!= 0){
        $activities->account_id = $id;
       }
       if($request->lead_id!=''){
        $activities->lead_id = $request->lead_id;
       }elseif($request->lead_id=='' && $id!= 0){
        $activities->lead_id = $id;
       }
       if($request->contact_id!=''){
        $activities->contact_id = $request->contact_id;
       }elseif($request->contact_id=='' && $id!= 0){
        $activities->contact_id = $id;
       }

       if($request->priority_id!=''){
        $activities->priority_id = $request->priority_id;
       }elseif($request->priority_id=='' && $id!= 0){
        $activities->priority_id = $id;
       }
       if($request->status_id!=''){
        $activities->account_status_id = $request->status_id;
       }elseif($request->status_id=='' && $id!= 0){
        $activities->account_status_id = $id;
       }
       $activities->description = $request->description;
       $activities->status = 1;
       $activities->updated_at = date('Y-m-d h:i:s');
       $activities->created_at = date('Y-m-d h:i:s');
       if($activities->save()){
        session()->flash('success','Activity Saved Successfully');
        return redirect()->route('activities');
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $id = $activity->id;
        if(Activity::destroy($id)){
        session()->flash('success','Records Deleted Successfully');
        return redirect()->route('activities');
        }
    }
}

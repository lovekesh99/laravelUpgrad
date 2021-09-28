<?php

namespace App\Http\Controllers\Crm;

use DB;
use App\Models\Lead;
use App\Models\Contact;
use App\Models\Activity;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      
       $user_id = session('USER_ID');
       $leads = Lead::where(['user_id'=>$user_id])->paginate(10);
       $lead_source_data = DB::table('leads')
       ->distinct()
       ->select('lead_source.id','lead_source.name')
       ->Join('lead_source','leads.lead_source_id','=','lead_source.id')
       ->get();
       $count = Lead::where(['user_id'=>$user_id])->count();
       /** Activity */
       $activity = Activity::where(['user_id'=>$user_id])->get()->toArray();
       if(isset($activity[0]['status'])){
       $activity = $activity[0]['status'];
       }else{
        $activity = 0;   
       }

       return view('crm.leads.leads',compact('leads','lead_source_data','count','activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** Get Lead Source Data */
       $lead_source = LeadSource::all();
       /** Get Lead Status Data */
       $lead_status = LeadStatus::all();
      return view('crm.leads.create',compact('lead_source','lead_status'));
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
            'company'=>'required',
            'email'=>'required|unique:leads',
            'lead_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'company.required'=>'Company cannot be empty',
            'email.required'=>'Email cannot be empty',  
            'lead_image.required'=>'Lead Image Field is required',
            'lead_image.mimes'=>'The Lead Image must be a file of type: jpeg, png, jpg.'       
        ]);
        
        $leads = new Lead();      
        $leads->user_id = session('USER_ID');
        $leads->lead_name = $request->lead_name;
        $leads->title = $request->title;
        $leads->mobile = $request->mobile;
        $leads->industry = $request->industry;
        $leads->lead_source_id = $request->lead_source;
        $leads->revenue = $request->revenue;
        $leads->company = $request->company;
        $leads->email = $request->email;
        $leads->lead_status_id = $request->lead_status;
        $leads->number_of_employees = $request->no_of_employees;
        $leads->skype_id = $request->skype_id;
        $leads->street = $request->street;
        $leads->state = $request->state;
        $leads->country = $request->country;
        $leads->city = $request->city;
        $leads->zip_code = $request->zip_code;
        $leads->description = $request->description;
        $leads->created_at = date('Y-m-d h:i:s');
        $leads->updated_at = date('Y-m-d h:i:s');
        if ($request->file('lead_image')) {
            $imagePath = $request->file('lead_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('lead_image')->storeAs('uploads/leads/images', $imageName, 'public');
            $leads->lead_image =$path;
          }
        if($leads->save()){
            session()->flash('success','Lead Information Saved Successfully');
            return redirect()->route('leads');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        /** Get Lead Data With ID */
        $id = $lead->id;
        $lead_data = Lead::find($id);

       /** Get Lead Source Data */
       $lead_source = LeadSource::all();

       /** Get Lead Status Data */
       $lead_status = LeadStatus::all();

        return view('crm.leads.edit',compact('lead_data','lead_source','lead_status'));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'company'=>'required',
            'email'=>'required|unique:leads',
            //'lead_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'company.required'=>'Company cannot be empty',
            'email.required'=>'Email cannot be empty',  
            'lead_image.required'=>'Lead Image Field is required',
            'lead_image.mimes'=>'The Lead Image must be a file of type: jpeg, png, jpg.'       
        ]);
        $id = $lead->id;
        $leads->user_id = session('USER_ID');
        $leads = Lead::find($id);
        $leads->lead_name = $request->lead_name;
        $leads->title = $request->title;
        $leads->mobile = $request->mobile;
        $leads->industry = $request->industry;
        $leads->lead_source_id = $request->lead_source;
        $leads->revenue = $request->revenue;
        $leads->company = $request->company;
        $leads->email = $request->email;
        $leads->lead_status_id = $request->lead_status;
        $leads->number_of_employees = $request->no_of_employees;
        $leads->skype_id = $request->skype_id;
        $leads->street = $request->street;
        $leads->state = $request->state;
        $leads->country = $request->country;
        $leads->city = $request->city;
        $leads->zip_code = $request->zip_code;
        $leads->description = $request->description;
        $leads->created_at = date('Y-m-d h:i:s');
        $leads->updated_at = date('Y-m-d h:i:s');
        if ($request->file('lead_image')) {
            $imagePath = $request->file('lead_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('lead_image')->storeAs('uploads/leads/images', $imageName, 'public');
            $leads->lead_image =$path;
          }
        $leads->lead_image = $leads->lead_image; 
        if($leads->save()){
            session()->flash('success','Lead Information Updated Successfully');
            return redirect()->route('leads');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {       
           $id = $lead->id;
            if(Lead::destroy($id)){ 
            session()->flash('success','Records Deleted Successfully');
            return redirect()->route('leads');
            }
       
    }

    public function convert(Request $request, Lead $lead, $status){
            $lead_id = $lead->id;
            $lead_status = $status;
        if($lead_status == 0){
           $leads = Lead::find($lead_id);
           $leads->status = 1;
           if($leads->save()){
            $leads_contacts = new Contact();
            $leads_name_explode =  explode(" ", $leads->lead_name);
            $leads_contacts->first_name =  $leads_name_explode[0];
            $leads_contacts->last_name =  $leads_name_explode[1];
            $leads_contacts->name =  $leads->lead_name;
            $leads_contacts->title =  $leads->title;
            $leads_contacts->account_id =  0;
            $leads_contacts->user_id =  $leads->user_id;
            $leads_contacts->email =  $leads->email;
            $leads_contacts->mobile =  $leads->mobile;
            $leads_contacts->industry =  $leads->industry;
            $leads_contacts->contact_image =  $leads->lead_image;
            $leads_contacts->lead_source_id =  $leads->lead_source_id;
            $leads_contacts->dob =  ' ';
            $leads_contacts->skype_id =  $leads->skype_id;
            $leads_contacts->street = $leads->street;
            $leads_contacts->state = $leads->state;
            $leads_contacts->country = $leads->country;
            $leads_contacts->city = $leads->city;
            $leads_contacts->zip_code = $leads->zip_code;
            $leads_contacts->description = $leads->description;
            if($leads_contacts->save()){
            session()->flash('success','Lead Converted');
            return redirect()->route('leads'); 
            }
           }

           
        }
    }
}

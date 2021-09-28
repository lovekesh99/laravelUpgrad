<?php

namespace App\Http\Controllers\Crm;

use DB;
use App\Models\Account;
use App\Models\Contact;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user_id = session('USER_ID');
       $contacts = Contact::where(['user_id'=>$user_id])->get();
       $count = Contact::where(['user_id'=>$user_id])->count();
       return view('crm.contacts.index',compact('contacts','count'));
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
        /** Get Account Data */
        $account_data = Account::all();
        return view('crm.contacts.create',compact('lead_source','lead_status','account_data'));
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
            'last_name'=>'required',
            'email'=>'required|unique:leads',
            'contact_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'last_name.required'=>'Last Name cannot be empty',
            'email.required'=>'Email cannot be empty',  
            'contact_image.required'=>'Contact Image Field is required',
            'contact_image.mimes'=>'The Contact Image must be a file of type: jpeg, png, jpg.'       
        ]); 
       
        $contacts = new Contact();
        $contacts->user_id = session('USER_ID');
        $contacts->first_name = $request->first_name;
        $contacts->last_name = $request->last_name;
        $contacts->title = $request->title;
        $contacts->account_id = $request->account_id;
        $contacts->mobile = $request->mobile;
        $contacts->industry = $request->industry;
        $contacts->lead_source_id = $request->lead_source_id;
        $contacts->email = $request->email;
        $contacts->dob = $request->dob;
        $contacts->skype_id = $request->skype_id;
        $contacts->street = $request->street;
        $contacts->state = $request->state;
        $contacts->country = $request->country;
        $contacts->city = $request->city;
        $contacts->zip_code = $request->zip_code;
        $contacts->description = $request->description;
        $contacts->created_at = date('Y-m-d h:i:s');
        $contacts->updated_at = date('Y-m-d h:i:s');
        if ($request->file('contact_image')) {
            $imagePath = $request->file('contact_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('contact_image')->storeAs('uploads/contacts/images', $imageName, 'public');
            $contacts->contact_image =$path;
          }
        if($contacts->save()){
            session()->flash('success','Contact Information Saved Successfully');
            return redirect()->route('contacts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        /** Get Contact Data With ID */
        $id = $contact->id;
        $contact_data = Contact::find($id);

       /** Get Lead Source Data */
       $lead_source = LeadSource::all();

        /** Get Account Data */
        $account_data = Account::all();

        return view('crm.contacts.edit',compact('contact_data','lead_source','account_data'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'last_name'=>'required',
            'email'=>'required|unique:contacts',
            //'contact_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'last_name.required'=>'Last Name cannot be empty',
            'email.required'=>'Email cannot be empty',  
            'contact_image.required'=>'Contact Image Field is required',
            'contact_image.mimes'=>'The Contact Image must be a file of type: jpeg, png, jpg.'       
        ]); 
        $id = $contact->id;
        $contacts = Contact::find($id);
        $contacts->user_id = session('USER_ID');
        $contacts->first_name = $request->first_name;
        $contacts->last_name = $request->last_name;
        $contacts->title = $request->title;
        $contacts->account_id = $request->account_id;
        $contacts->mobile = $request->mobile;
        $contacts->industry = $request->industry;
        $contacts->lead_source_id = $request->lead_source_id;
        $contacts->email = $request->email;
        $contacts->dob = $request->dob;
        $contacts->skype_id = $request->skype_id;
        $contacts->street = $request->street;
        $contacts->state = $request->state;
        $contacts->country = $request->country;
        $contacts->city = $request->city;
        $contacts->zip_code = $request->zip_code;
        $contacts->description = $request->description;
        $contacts->created_at = date('Y-m-d h:i:s');
        $contacts->updated_at = date('Y-m-d h:i:s');
        if ($request->file('contact_image')) {
            $imagePath = $request->file('contact_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('contact_image')->storeAs('uploads/contacts/images', $imageName, 'public');
            $contacts->contact_image =$path;
          }
          $contacts->contact_image = $contacts->contact_image; 
        if($contacts->save()){
            session()->flash('success','Contact Information Updated Successfully');
            return redirect()->route('contacts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
            $id = $contact->id;
            if(Contact::destroy($id)){ 
            session()->flash('success','Records Deleted Successfully');
            return redirect()->route('contacts');
            }
    }
}

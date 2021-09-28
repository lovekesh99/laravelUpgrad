<?php

namespace App\Http\Controllers\Crm;

use App\Models\Rating;
use App\Models\Account;
use App\Models\Industry;
use App\Models\Ownership;
use App\Models\AccountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = session('USER_ID');
        $accounts = Account::where(['user_id'=>$user_id])->get();
        $count = Account::where(['user_id'=>$user_id])->count();
        return view('crm.accounts.index',compact('accounts','count'));  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** Get Account Type Data */
        $account_type = AccountType::all();
         /** Get Rating Data */       
        $rating_data = Rating::all();
        /** Get Ownership Data */       
        $ownership_data = Ownership::all();
        /** Get Industry Data */       
        $industry_data = Industry::all();
        return view('crm.accounts.create',compact('account_type','rating_data','ownership_data','industry_data'));
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
            'account_name'=>'required',
            'account_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'account_name.required'=>'Account Name cannot be empty', 
            'account_image.required'=>'Account Image Field is required',
            'account_image.mimes'=>'The Account Image must be a file of type: jpeg, png, jpg.'       
        ]); 
       
        $accounts = new Account();
        $accounts->user_id = session('USER_ID');
        $accounts->account_name = $request->account_name;
        $accounts->account_site = $request->account_site;
        $accounts->account_number = $request->account_number;
        $accounts->account_type_id =  $request->account_type_id;
        $accounts->mobile = $request->mobile;
        $accounts->industry_id = $request->industry_id;
        $accounts->revenue = $request->revenue;
        $accounts->rating_id = $request->rating_id;
        $accounts->employees = $request->employees;
        $accounts->ownership_id = $request->ownership_id;
        $accounts->street = $request->street;
        $accounts->state = $request->state;
        $accounts->country = $request->country;
        $accounts->city = $request->city;
        $accounts->zip_code = $request->zip_code;
        $accounts->description = $request->description;
        $accounts->created_at = date('Y-m-d h:i:s');
        $accounts->updated_at = date('Y-m-d h:i:s');
        if ($request->file('account_image')) {
            $imagePath = $request->file('account_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('account_image')->storeAs('uploads/accounts/images', $imageName, 'public');
            $accounts->account_image =$path;
          }
         
        if($accounts->save()){
            session()->flash('success','Account Informations Saved Successfully');
            return redirect()->route('accounts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        /** Get Account Data With ID */
        $id = $account->id;
        $account_data = Account::find($id);
        /** Get Account Type Data */
        $account_type = AccountType::all();
         /** Get Rating Data */       
        $rating_data = Rating::all();
        /** Get Ownership Data */       
        $ownership_data = Ownership::all();
        /** Get Industry Data */       
        $industry_data = Industry::all();        
        return view('crm.accounts.edit',compact('account_data','account_type','rating_data','ownership_data','industry_data'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_name'=>'required',
            //'account_image'=>'required|mimes:jpeg,png,jpg'
        ],[
            'account_name.required'=>'Account Name cannot be empty', 
            'account_image.required'=>'Account Image Field is required',
            'account_image.mimes'=>'The Account Image must be a file of type: jpeg, png, jpg.'       
        ]); 
        $id = $account->id;
        $accounts = Account::find($id);
        $accounts->user_id = session('USER_ID');
        $accounts->account_name = $request->account_name;
        $accounts->account_site = $request->account_site;
        $accounts->account_number = $request->account_number;
        $accounts->account_type_id = $request->account_type_id;
        $accounts->mobile = $request->mobile;
        $accounts->industry_id = $request->industry_id;
        $accounts->revenue = $request->revenue;
        $accounts->rating_id =  $request->rating_id;
        $accounts->employees = $request->employees;
        $accounts->ownership_id = $request->ownership_id;
        $accounts->street = $request->street;
        $accounts->state = $request->state;
        $accounts->country = $request->country;
        $accounts->city = $request->city;
        $accounts->zip_code = $request->zip_code;
        $accounts->description = $request->description;
        $accounts->created_at = date('Y-m-d h:i:s');
        $accounts->updated_at = date('Y-m-d h:i:s');
        if ($request->file('account_image')) {
            $imagePath = $request->file('account_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('account_image')->storeAs('uploads/accounts/images', $imageName, 'public');
            $accounts->account_image =$path;
          }
          $accounts->account_image =$accounts->account_image;
        if($accounts->save()){
            session()->flash('success','Account Informations Updated Successfully');
            return redirect()->route('accounts');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
           $id = $account->id;
            if(Account::destroy($id)){ 
            session()->flash('success','Records Deleted Successfully');
            return redirect()->route('accounts');
            }
    }
}

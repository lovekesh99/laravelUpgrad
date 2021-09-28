<?php

namespace App\Http\Controllers\Crm;

use DB;
use App\Models\Lead;
use App\Models\User;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleid = session()->get('ROLE_ID');
        if(session()->has('USER_LOGIN') && $roleid == 2){
            return redirect('crm/dashboard');
        }else{
          
        }
        return view('crm.login');
    }
    public function dashboard()
    {
        $user_id = session('USER_ID');
        $count_lead = Lead::where(['user_id'=>$user_id])->count();
        $leads = Lead::where(['user_id'=>$user_id])->get();
        $lead_source_data = DB::table('leads')
       ->distinct()
       ->select('lead_source.id','lead_source.name')
       ->Join('lead_source','leads.lead_source_id','=','lead_source.id')
       ->get();
       $contacts = Contact::where(['user_id'=>$user_id])->get();
       $count_contact = Contact::where(['user_id'=>$user_id])->count();
       $accounts = Account::where(['user_id'=>$user_id])->get();
       $count_account = Account::where(['user_id'=>$user_id])->count();
        return view('crm.dashboard',compact('count_lead','count_contact','count_account','leads','lead_source_data','contacts','accounts'));

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
        //
    }
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        //print_r($request->all());
        //$result = Admin::where(['email'=>$email,'password'=>$password])->get();
        $result = User::where(['email'=>$email])->get();     
        if(isset($result[0]['id'])){
            $password = Hash::check($request->post('password'),$result[0]['password']);
            if($password==1){
                $request->session()->put('USER_LOGIN',true);
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('USER_NAME',$result[0]['name']);
                $request->session()->put('USER_EMAIL',$result[0]['email']);
                $request->session()->put('ROLE_ID',$result[0]['role_id']);
                $request->session()->put('USER_ID',$result[0]['id']);
                $adminlogin = $request->session()->get('ADMIN_LOGIN');
                $roleid = $request->session()->get('ROLE_ID');
                if($adminlogin == 1 && $roleid == 1){
                    return redirect('admin/dashboard');
                }elseif($adminlogin == 1 && $roleid == 2){
                    return redirect('crm/dashboard');
                }
            }else{
                $request->session()->flash('error','Email & Password Does Not Matched');
                return redirect('crm/login');    
            }
        }else{
            $request->session()->flash('error','Please Enter Correct Login Details');
            return redirect('crm/login');
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
        //
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
        //
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
}

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Crm\CrmController;
use App\Http\Controllers\Crm\LeadController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Crm\AccountController;
use App\Http\Controllers\Crm\ContactController;
use App\Http\Controllers\Crm\ActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('crm/auth',[CrmController::class, 'auth'])->name('auth.name');
Route::get('crm/login',[CrmController::class,'index'])->name('auth.login');

/* Route::group(['prefix'=>'crm','as','crm.', 'namespace'=> 'Crm', 'middleware'=>['auth','crm']], function(){
    Route::get('dashboard',[CrmController::class, 'dashboard'])->name('dashboard');
}); */


/** User Routes */
Route::group(['prefix'=>'crm','as','crm.', 'namespace'=> 'Crm', 'middleware'=>['user_auth']], function(){
    Route::get('dashboard',[CrmController::class, 'dashboard'])->name('dashboard');

    /* Routes For leads */
    Route::get('leads',[LeadController::class, 'index'])->name('leads');
    Route::get('leads/create',[LeadController::class, 'create'])->name('leads.create');
    Route::get('leads/edit/{lead}',[LeadController::class, 'edit'])->name('leads.edit');
    Route::post('leads/update/{lead}',[LeadController::class, 'update'])->name('leads.update');
    Route::get('leads/destroy/{lead}',[LeadController::class, 'destroy'])->name('leads.destroy');
    Route::post('leads/store',[LeadController::class, 'store'])->name('leads.store');
    Route::get('leads/convert/{lead}/{status}',[LeadController::class, 'convert'])->name('leads.convert');

    /* Routes For Contacts */
    Route::get('contacts',[ContactController::class, 'index'])->name('contacts');
    Route::get('contacts/create',[ContactController::class, 'create'])->name('contacts.create');
    Route::get('contacts/edit/{contact}',[ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('contacts/update/{contact}',[ContactController::class, 'update'])->name('contacts.update');
    Route::get('contacts/destroy/{contact}',[ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('contacts/store',[ContactController::class, 'store'])->name('contacts.store');

    /*  Routes For Accounts*/
    Route::get('accounts',[AccountController::class, 'index'])->name('accounts');
    Route::get('accounts/create',[AccountController::class, 'create'])->name('accounts.create');
    Route::get('accounts/edit/{account}',[AccountController::class, 'edit'])->name('accounts.edit');
    Route::post('accounts/update/{account}',[AccountController::class, 'update'])->name('accounts.update');
    Route::get('accounts/destroy/{account}',[AccountController::class, 'destroy'])->name('accounts.destroy');
    Route::post('accounts/store',[AccountController::class, 'store'])->name('accounts.store');

    /*  Routes For Activity*/
    Route::get('activities',[ActivityController::class, 'index'])->name('activities');
    Route::get('activities/create/{id}',[ActivityController::class, 'create'])->name('activities.create');
    Route::get('activities/edit/{activity}',[ActivityController::class, 'edit'])->name('activities.edit');
    Route::post('activities/update/{activity}',[ActivityController::class, 'update'])->name('activities.update');
    Route::get('activities/destroy/{activity}',[ActivityController::class, 'destroy'])->name('activities.destroy');
    Route::post('activities/store/{id}',[ActivityController::class, 'store'])->name('activities.store');


    Route::get('logout', function() {
        session()->forget('USER_LOGIN');
        session()->forget('ADMIN_LOGIN');
        session()->forget('USER_EMAIL');
        session()->forget('USER_ID');
        session()->forget('ROLE_ID');
        session()->flash('error','Logout Succesfully');
        return redirect()->route('auth.login');
    });
});

/** Admin Routes */
Route::group(['prefix'=>'admin','as','admin.', 'namespace'=> 'Crm', 'middleware'=>['admin_auth']], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('dashboard');
    Route::get('admin/logout', function () {
        session()->forget('USER_LOGIN');
        session()->forget('ADMIN_LOGIN');
        session()->forget('USER_EMAIL');
        session()->forget('USER_ID');
        session()->forget('ROLE_ID');
        session()->flash('error','Logout Succesfully');
        return redirect()->route('auth.login');
    });
});


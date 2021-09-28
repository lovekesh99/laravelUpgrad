<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role_id = $request->session()->get('ROLE_ID');
        if($request->session()->has('USER_LOGIN') && $role_id == 2 ){

        }else{
            $request->session()->flash('error','Access Denied');
            return redirect('crm/login');
        }
        return $next($request);
    }
}

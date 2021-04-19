<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Test
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
        if(Auth::check()){
            if(Auth::user()->userType=== 'Admin'){
            //    dd('you are login by Admin');
                return redirect()->route('hr.dashboard');
            }else if(Auth::user()->userType=== 'User'){
                // dd('you are login by User');
                return redirect()->route('accounts.dashboard');
             }
        }else{
            return redirect()->route('login');
        }
    }
}

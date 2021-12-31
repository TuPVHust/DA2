<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }


    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        // dd('oki');
        if (Auth::check()){
            $user=Auth::user();
            if (($user->status==1)){
                return $next($request);
            } else{
                Auth::logout();
                return redirect()->route('login')->with('alert-danger','Tài khoản của bạn đã bị hạn chế quyền truy cập!!');
            }
        } 
        else {
            return redirect()->route('login');
        }
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

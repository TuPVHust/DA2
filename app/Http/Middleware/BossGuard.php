<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class BossGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            $user=Auth::user();
            if (($user->status==1 && ($user->role==1 || $user->role==2))){
                return $next($request);
            } else{
                Auth::logout();
                return redirect()->route('login')->with('alert-danger','Tài khoản của bạn không có quyền truy cập trang này, hoặc đã bị hạn chế quyền truy cập');
            }
        } 
        else {
            return redirect()->route('login');
        }
    }
}

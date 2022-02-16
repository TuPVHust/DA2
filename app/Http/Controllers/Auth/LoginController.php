<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
    {
        // Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
     
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // dd(Auth::user()->role);
            if(Auth::user()->role == 2){
                return redirect()->route('home');
            }
            elseif(Auth::user()->role == 1)
            {
                return redirect()->route('boss.dashboard');
            }
            elseif(Auth::user()->role == 0){
                return redirect()->route('staff.index');
            }
            else{
                return redirect()->route('logout');
            }
        }
        return redirect("login")->with('alert-danger','Thông tin tài khoản hoặc mật khẩu không đúng.');
    }
}

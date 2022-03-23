<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index(){
        return view('admin.logins.login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
         $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt(['email' => $email, 'password' => $password], $remember)){
            if($request->has('remember_me')){
                Cookie::queue('email', $email, 30);
                Cookie::queue('password', $password, 30);
            }
            
        } 
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            toastr()->success('You have logged in successfully', 'Success');
            return redirect()->route('admin.home');
        }

        toastr()->error('Not found email or password', 'Error');
        return redirect()->back();
    }
    public function log_out(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
{
    public function login(){
    	if (Auth::check()) {
            return redirect('admin/dashboard');
        } else {
            return view('backend.auth.login');
        }
    }

    public function getLogin(Request $request){
        $arr = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'role' => 9,
        ];
        if (Auth::attempt($arr)){
            return redirect('admin/dashboard');
        } else {
            return Redirect::to('/login')->with('message', 'Mật khẩu hoặc tài khoản không chính xác');
        }
    }

    public function logOut(){
    	Auth::logout();
        return redirect('/login');
    }
}

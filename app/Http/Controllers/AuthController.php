<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
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

    public function getRegister(){
        return view('backend.auth.register');
    }

    public function postRegister(Request $request){
        $data = $request->all();
        $request->validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required',
          'password' => 'required',
          'repeat_password' => 'required'
        ]);
        $name = $data['first_name']. " ". $data['last_name'];
        if ($data['password'] !=  $data['repeat_password']) {
             return Redirect::to('/register')->with('message', 'mật khẩu không khớp');
        }
         $password = bcrypt($data['password']);
        User::create([
            'name' => $name,
            'email' => strtolower($data['email']),
            'password' => $password,
            'phone' => '',
            'role' => 2
        ]);

        return Redirect::to('/login')->with('message','đăng kí thành công');
    }
}

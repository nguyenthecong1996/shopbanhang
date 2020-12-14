<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\TblUser;
use App\Models\TblBrand;
use App\Models\TblCategory;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->category = TblCategory::select('category_name', 'category_id', 'category_image')->where('category_status', 1)->orderBy('updated_at', 'desc')->get();
        $this->brand = TblBrand::select('brand_name', 'brand_id', 'brand_image')->where('brand_status', 1)->orderBy('updated_at', 'desc')->get();
    }

    public function login(){
    	if (Auth::guard('admin')->check()) {
            // dd(Auth::guard('admin')->user());
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
        if (Auth::guard('admin')->attempt($arr)){
            return redirect('admin/dashboard');
        } else {
            return Redirect::to('/login')->with('message', 'Mật khẩu hoặc tài khoản không chính xác');
        }
    }

    public function loginUser(){
        $getCategory = $this->category;
        $getBrand =  $this->brand; 
        if (Auth::guard('writer')->check()) {
            return redirect('/');
        } else {
            return view('frontend.auth', compact('getCategory', 'getBrand'));
        }
    }

    public function getLoginUser(Request $request){
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
            // 'role' => 1,
        ];
        // dd(Auth::guard('writer')->check());
        if (Auth::guard('writer')->attempt($arr)){
            return redirect('/');
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

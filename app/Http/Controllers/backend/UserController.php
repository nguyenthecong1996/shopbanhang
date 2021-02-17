<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function allUser(){
    	$getData = User::find(6);
    	dd($getData->role());
    	return view('backend.user.all_user', compact('getData'));
    }
}

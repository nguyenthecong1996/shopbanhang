<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
    	return Socialite::driver('facebook')->redirect(); 
    }

    public function handleProviderCallback()
    {
    	// dd(1);
	            // Sau khi xác thực Facebook chuyển hướng về đây cùng với một token
            // Các xử lý liên quan đến đăng nhập bằng mạng xã hội cũng đưa vào đây.  
            // dd(Socialite::driver('facebook')->user());  
    	$getInfo =  Socialite::driver('facebook')->user();
        $user = $this->createUser($getInfo,'facebook');
        auth()->login($user); 
        return redirect('admin/dashboard');
    }

    function createUser($getInfo,$provider){
         $user = User::where('provider_id', $getInfo->id)->first();
         if (!$user) {
              $user = User::create([
                 'name'     => $getInfo->name,
                 'email'    => $getInfo->email,
                 'provider' => $provider,
                 'provider_id' => $getInfo->id
             ]);
           }
        return $user;
    }
}

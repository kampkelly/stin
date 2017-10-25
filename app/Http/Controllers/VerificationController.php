<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
//use Request;
use App\User;
use App\Mail\Welcome;

class VerificationController extends Controller
{

     public function toverify_email(){ 
            return view('auth/toverify_email');       
    }

    public function verify($token, $username){ 
    	$user = User::where('username', $username)->first();
    	if($user->verification_token == $token AND $user->username == $username){
    		$user->verified = 1;
    		$user->save();
            return view('auth/emailverified');       
    	}else{
    		dd('Invalid request, the link is invalid!');
    	}
    }

}

<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
//use Request;
use App\User;
use App\Mail\Welcome;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
 
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







    //////////////CONNECT GOOGLE, FACEBOOK

    public function handleProviderCallback($provider)
    {
        try {
            $provideduser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return Redirect::to('connect/'.$provider);
        }

    //    $authUser = $this->findOrCreateUser($provideduser, $provider);
        $authUser = $this->SaveUserDetails($provideduser, $provider);
    //    $authUser = $this->findOrCreateUser($githubUser);
      //  return 'verifi';
        if(1 == 1) {
            $user = Auth::user();
            $user->website = $provideduser->name;
            $user->save(); 
      //      return $provideduser->name;
            return Redirect::to('/contact');
        }
      //  Auth::login($authUser, true);

        return Redirect::to('/');
    }

      private function SaveUserDetails($provideduser, $provider)
    {
      
    }

}

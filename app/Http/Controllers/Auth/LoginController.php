<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeToTheinnovestors;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

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

   // use AuthenticatesUsers;
    //TO CHANGE LOGOUT BEGINS
    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
      //  return redirect()->route('your_route');
      //  \Mail::to($user)->send(new Welcome($user));
        return redirect('/');
    }

    //socialite login
     public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

     public function handleProviderCallback($provider)
    {
        try {
            $provideduser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$provider);
        }

        if(Auth::check()) {
            $user = Auth::user();
            $user->website = $provideduser->name;
            $user->save(); 
            $k = $provideduser;
        //    dd($k);
        //    return Redirect::to('/dashboard#//innovations');
        }

        $authUser = $this->findOrCreateUser($provideduser, $provider);
        $user = $authUser;

        Auth::login($authUser, true);
        \Mail::to($user)->send(new WelcomeToTheinnovestors($user));

        

        return Redirect::to('/');
    }

     public function ConnectUser($provideduser, $provider) {
     
    }

     private function findOrCreateUser($provideduser, $provider)
    {
        if ($authUser = User::where('provider_id', $provideduser->id)->first()) {
             return $authUser;
        }
        $verification_token = str_random(20);
        if($provider == 'google' || $provider == 'facebook') {
            $random_no = (rand(100,999));
          //  $random_no = "$random_no";
            $generated_username = substr($provideduser->name,0,6) . $random_no;
            return User::create([
              //  'name' => $githubUser->nickname,  for github
                'fullname' => $provideduser->name,
                'username' => $generated_username,
                'email' => $provideduser->email,
                'provider' => $provider,
                'provider_id' => $provideduser->id,
           //     'avatar' => $provideduser->avatar,
                'verification_token' => $verification_token,
                'is_permission'=> '0',
                'status' => 'pending'
            ]);
        }

        if($provider == 'github') {
            $random_no = (rand(100,999));
            $random_no = "$random_no";
            $generated_username = substr($provideduser->name,0,4) . $random_no;
            $generated_name = $provideduser->nickname . "from github";
            return User::create([
                'fullname' => $generated_name,
                'username' => $provideduser->nickname . $random_no,
                'email' => $provideduser->email,
                'provider' => $provider,
                'provider_id' => $provideduser->id,
                'verification_token' => $verification_token,
                'is_permission'=> '0',
                'status' => 'pending'
            ]);
        }
    }

   

    //socialite login

    //TO CHANGE LOGOUT ENDS
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // session()->flash('message', 'Please complete your profile!'); 
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'redirectToProvider', 'ConnectUser', 'handleProviderCallback', 'findOrCreateUser');
    }

     public function test_ajax()
    {
        return ['Name', 'Email', 'Password', "Username"];
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
}

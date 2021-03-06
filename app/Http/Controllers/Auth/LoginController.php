<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeToTheinnovestors;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
      //  $user = $authUser;

      //  \Mail::to($user)->send(new WelcomeToTheinnovestors($user));
        Auth::login($authUser, true);

        

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
            $generated_username = strtr($generated_username, ' ', '_');
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
   // protected $redirectTo = '/dashboard#/innovations';
    protected $redirectTo = '/dashboard#';

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

    public function custom_login_for_remember(Request $request)
    {
        if($authUser = User::where('email', $request->email)->orWhere('username', $request->email)->first()) {
            if (Hash::check($request->password, $authUser->password)) {
                $hashed = Hash::make('plain-text');
                        Auth::login($authUser);
                        return Redirect::to('/');
            }else{ }
        }else{ }

        return ['Name', 'Email', 'Password', "Username"];
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->getallheaders()($this->username()),
            'password' => $request->password,
        ];
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        $ar = [ response()->json(compact('token')) ];
      //  return $ar;
        return response()->json(compact('token'));
    }
}

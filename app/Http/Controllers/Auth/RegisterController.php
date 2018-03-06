<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\VerificationUser;
use App\Mail\WelcomeToTheinnovestors;
use App\Http\Controllers\Mail\Mailer;
//use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendVerificationEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'website' => 'max:255',
            'facebook' => 'max:255',
            'linkedin' => 'max:255',
            'twitter' => 'max:255',
            'bio' => 'required|max:255',
            'contacts' => 'required|max:255',
            'specialization_id' => 'required|max:255', 
        ]);
    }

    /**
     * Create a new user instance after a valid registration. name, address, state, country, age, profile_picture, contacts, social_profiles(linked, facebook, twitter, google+), bio, highest_education_attained, profession, interests/hobbies, website
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'state' => $data['state'],
            'country' => $data['country'],
            'website' => $data['website'],
            'facebook' => $data['facebook'],
            'linkedin' => $data['linkedin'],
            'twitter' => $data['twitter'],
            'bio' => $data['bio'],
            'contacts' => $data['contacts'],
            'specialization_id' => $data['specialization_id'],
            'is_permission'=> '1'
        ]); 
    }

     public function signup(){
        $countries = DB::select("SELECT * FROM countries Order BY id asc");
        $categories = Category::orderBy('id', 'desc')->get();
      //  $users = DB::connection('mysql2')->select(...);
        return view('auth.signup', compact('countries', 'categories'));
       // return view('startups.edit', compact('startup', 'categories'));
    }

    public function innovator(){
        $countries = DB::select("SELECT * FROM countries Order BY id asc");
        $categories = Category::orderBy('id', 'desc')->get();
      //  $users = DB::connection('mysql2')->select(...);
        return view('auth.innovator_register', compact('countries', 'categories'));
       // return view('startups.edit', compact('startup', 'categories'));
    }

    public function signupinnovator(Request $request){

               $this->validate($request, [
                'fullname' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password'=> 'required|min:6',
                'username'=>'required|min:1'
            ]);  
               $verification_token = str_random(20);
               $username = strtr($request->username, ' ', '_');
           $user = User::create([
            'fullname' => $request->fullname,
            'username' => $username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
          //  'is_permission'=> $request->permission,
            'verification_token' => $verification_token,
            'is_permission'=> '0',
            'status' => 'pending'
           ]);
        //   \Mail::to($user)->send(new VerificationUser($user));
           \Mail::to($user)->send(new WelcomeToTheinnovestors($user));

        /*   \Mail::send('emails.verification-user', ['user' => $user], function ($message){
                $message->to('kampkelly@live.com')->subject('Expertphp.in - Testing mail');
            }); */

            $cookie_value = $request->username;
         //   $this->dispatch((new SendVerificationEmail($user)));
            session()->flash('message', 'Welcome, Please login to your account'); 
             return redirect('/login');
           //  return redirect('/toverify_email');
    }

    public function investor(){

        $countries = DB::select("SELECT * FROM countries Order BY id asc");
        $categories = Category::orderBy('id', 'desc')->get();
        return view('auth.register', compact('countries', 'categories'));
    }

    public function postinvestor(Request $request){  

               $this->validate($request, [
                'company_name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password'=> 'required|min:6',
                'username'=>'required|min:8'
            ]);  

           $verification_token = str_random(20);
           $user = User::create([
            'company_name' => $request->company_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
          //  'is_permission'=> $request->permission,
            'verification_token' => $verification_token,
            'is_permission'=> '1',
            'status' => 'pending'
           ]);
        //   \Mail::to($user)->send(new VerificationUser($user));

        
        //    $cookie_value = $request->username;
           
           session()->flash('message', 'Please login'); 
             return redirect('/login');
            // return redirect('/toverify_email');
    }

}

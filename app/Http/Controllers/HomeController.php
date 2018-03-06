<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Sendcontact;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Startup;
use App\Post;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class HomeController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home','sendcontact', 'jwauth', 'jw']]);
    }

    public function home()
    {
     $startups =  Startup::where('status', 'pending')->orWhere('status', 'approved')->orderBy('id', 'desc')->take(5);
     $posts = Post::orderBy('id', 'desc')->simplePaginate(1);
      return view('new_home', compact('startups', 'posts'));
    }

    public function authenticate()
    {
        $email = 'kampkelly@live.com'; $password = 'password';
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('/dashboard');
        }
    }

     public function sendcontact(Request $request)
    {
        $name = $request->contact_name;
        $email = $request->contact_email;
        $message = $request->contact_msg;
        $email_data = array(
          //   'recipient' => $user->user_email,
             'recipient' => 'support@theinnovestors.com',
             'subject' => 'User Message From TheInnovestors'
              );
                $contact_data = array(
                'email' => $request->contact_email,
                'name' => $request->contact_name,
                'messag' => $request->contact_msg
            );
            //    $contact_data = json_encode($contact_data);
             //   \Mail::to($request->contact_email)->send(new Sendcontact($contact_data));
              Mail::send('emails.contact_message', $contact_data, function($message) use ($email_data) {
                  $message->to( $email_data['recipient'] )
                          ->subject( $email_data['subject'] );
              }); 
              session()->flash('message', 'Message Sent!');
              return view('/contact');
    }

    public function getnotified(Request $request)
    {
        $email = $request->email;
        $email_data = array(
          //   'recipient' => $user->user_email,
             'recipient' => 'support@theinnovestors.com',
             'subject' => 'Get Notified Message From TheInnovestors'
              );
                $view_data = array(
                'email' => $request->email
            );

              Mail::send('emails.contact_message', $view_data, function($message) use ($email_data) {
                  $message->to( $email_data['recipient'] )
                          ->subject( $email_data['subject'] );
              }); 
              session()->flash('message', 'Message Sent!');
           //   return view('/contact');
           //   return redirect()->back();
              return 'cool';
    }

    public function request_partner(Request $request) {
      
    }

    public function jwauth(Request $request, $tok) {
      // this will set the token on the object
  //    $token = JWTAuth::setToken($tok);
//      $token = JWTAuth::getToken();
      $user = JWTAuth::parseToken()->authenticate();
      return $user;
 //   JWTAuth::parseToken();

    // and you can continue to chain methods
   // $user = JWTAuth::parseToken()->authenticate();
    //$user = $tok->authenticate();
   // return $user;
  //  return response()->json(compact('user'));
    }

    public function jw() {
      
    }

}

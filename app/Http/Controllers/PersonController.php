<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Startup;
use App\Category;
use App\StartupsPhoto;
use App\YoutubeVideo;
use App\Mail\Welcome;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;
//use Intervention\Image\Facades\Image as Image;
use Image;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendVerificationEmail;
use LRedis;

class PersonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
       # $this->middleware('guest', ['except' => ['index']]);
    }

       public function myprofile($username)
    {
        $auth = Auth::user();
        $user = User::where('username', $username)->with('startups')->first();
     //   $threads = Startup::where( ('user_id', Auth::user()->id) )->orWhere('status', 'approved')->orderBy('id', 'desc')->paginate(6);
        $threads = DB::select("SELECT * FROM threads WHERE (user_id = '".Auth::user()->id."' AND receiver_id = '".$user->id."') OR (user_id = '".$user->id."' AND receiver_id = '".Auth::user()->id."') Order BY id desc");
        $authfriends = Auth::user()->getFriends();
         $users = User::all();
         $userfriends = $user->getFriends();
         $mutual_friends = Auth::user()->getMutualFriends($user);
         //requests logic
         if($auth->isFriendWith($user)){
            $isfriend = true;
        }else {$isfriend = false;}
        if($auth->hasFriendRequestFrom($user)){
            $friendrequestfrom = true;
        }else {$friendrequestfrom = false;}
        if($auth->hasSentFriendRequestTo($user)){
            $sentfriendrequest = true;
        }else {$sentfriendrequest = false;}
        //requests logic
         if($user->is_permission == 0){
       //  if($user->is_permission == 0 OR checkPermission(['investor', 'admin'])){
         $startups = $user->startups()->where('status', 'approved')->orWhere('status', 'pending')->orderBy('id', 'desc')->get();
         $youtubevideos = $user->youtubevideos()->orderBy('id', 'desc')->get();
         $requests = $auth->getFriendRequests();
      //   \Mail::to($user)->send(new Welcome($user));
     //  return view('users.innovator_profile', compact('user', 'startups', 'youtubevideos', 'users', 'userfriends', 'mutual_friends', 'friends', 'threads'));
            $thedata = [$auth, $user, $users, $authfriends, $userfriends, $mutual_friends, $startups, $youtubevideos, $threads, $requests, $isfriend, $friendrequestfrom, $sentfriendrequest];
            return $thedata;
       }else{
        $thedata = [];
        return $thedata;
       // return redirect('/startups');
       }
    } 

     public function investor_profile($username)
    {
        
        // $user = User::find($id);
        $friends = Auth::user()->getFriends($perPage = 20);
         $user = User::where('username', $username)->first();
         $users = User::all();
         $friends_pag = $user->getFriends($perPage = 20);
         $mutual_friends = Auth::user()->getMutualFriends($user, $perPage = 20);
         if($user->is_permission == 1){
       // if(checkPermission(['investor', 'admin'])) {
         $startups = $user->startups()->where('status', 'pending')->orderBy('id', 'desc')->paginate(6);
         $youtubevideos = $user->youtubevideos()->orderBy('id', 'desc')->get();
       //  \Mail::to($user)->send(new Welcome($user));
       return view('users.investor_profile', compact('user', 'startups', 'youtubevideos', 'users', 'friends_pag', 'mutual_friends', 'friends'));
       }else{
        return redirect('/startups');
       }
    }   

    public function investor_profile_edit($username)
    {
        
        $user = User::where('username', $username)->first();
       //  $startups = Startup::where('status', 'pending')->orderBy('id', 'desc')->simplePaginate(1); 
         $countries = DB::select("SELECT * FROM countries Order BY id asc");
       return view('users.investor_edit', compact('user', 'countries'));
    }  

     public function pic_update(Request $request, $username)
    {
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
            Image::make($file)->resize(300, 300)->save(public_path('/uploads/profile-pic/'. $newfilename));
           // $file->move('uploads/profile-pic', $newfilename);
        }
        
         $user = User::where('username', $username)->first();
         if(Auth::user()->username == $username){
            if (Input::hasFile('image')) $user->image = $newfilename;
            $user->save();

            session()->flash('message', 'Profile Pic Updated'); //
            return redirect()->back();
        }else{
            session()->flash('message', 'Unauthorized Action!'); //
            return redirect()->back();
        }
    }  

    public function myinnovations($username)
    {
        if($username == Auth::user()->username) {
          //  $auth = Auth::user();
            $auth = User::where('username', $username)->with('startups')->first();
            $startups = $auth->startups()->where('status', 'approved')->orWhere('status', 'pending')->orderBy('id', 'desc')->get();
            $youtubevideos = $auth->youtubevideos()->orderBy('id', 'desc')->get();
            $thedata = [$auth, $startups, $youtubevideos];
            return $thedata;
        }else {
            $thedata = [];
            return $thedata;
        }
    }

    public function destroy($id)
    {
        //
    }
}

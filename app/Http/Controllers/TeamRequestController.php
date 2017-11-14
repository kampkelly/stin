<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\TeamRequest;
use App\RequestMember;
use App\Mail\RequestTeamup;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeToTheinnovestors;


class TeamRequestController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('guest', ['except' => ['mine', 'edit', 'update']]);
        $this->middleware('auth')->only('mine');
    }

    public function index()
    {
        $request_teams = TeamRequest::where('status', 'active')->orderBy('id', 'desc')->take(15)->get();
      //  return $findpartners;
            return view('team_requests/index', compact('request_teams'));

    }

    public function mine()
    {
        $requests = TeamRequest::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(15)->get();
            return view('team_requests/mine', compact('requests'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //slug
        $slug_type = $request->type;
        $slug_category = strtr($request->category, ' ', '-');
        $slug_description = substr($request->description,0,15);
        $slug_date = date("Y-m-d-i-s-a");
        $slug_combine = $slug_type.' '.$slug_category.' '.$slug_description.' '.$slug_date;
        $slug_format = strtr($slug_combine, ' ', '-');
        $slug = $slug_format;
        //slug
        if(Auth::guest()){ 
            $verification_token = str_random(20);
            $random = (rand(100,999));
            $username = substr($request->name,0,3) . $random;
            $username = strtr($username, ' ', '_');
            if ($authUser = User::where('email', $request->email)->orWhere('username', $username)->first()) {
                session()->flash('message', 'This user exists already, please login before requesting!');
                return redirect()->back();
            }
            $username = strtr($username, ' ', '_');
            $user = User::create([
                'fullname' => $request->name,
                'username' => $username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
              //  'is_permission'=> $request->permission,
                'verification_token' => $verification_token,
                'is_permission'=> '0',
                'status' => 'pending'
               ]);

            $request_team = TeamRequest::create([
                'type' => $request->type,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'user_id' => $user->id,
                'additional' => $request->additional,
      /*          'phone' => $request->phone,
                'name' => $request->name,
                'email' => $request->email,
                'username' => $username, */
                'status' => 'active',
                'slug' => $slug
               ]);

            if($role1 = $request->role1){
                $this->store_member($role1, $request->function_1, $request_team);
            }if($role2 = $request->role2){
                $this->store_member($role2, $request->function_2, $request_team);
            }if($role3 = $request->role3){
                $this->store_member($role3, $request->function_3, $request_team);
            }if($role4 = $request->role4){
                $this->store_member($role4, $request->function_4, $request_team);
            }
            
            \Mail::to($user)->send(new WelcomeToTheinnovestors($user));
             \Mail::to($user)->send(new RequestTeamup($user));
            session()->flash('message', 'Request Submitted, please login to manage and view profile!');
                  return redirect('/login');
        }else{
             $request_team = TeamRequest::create([
                'type' => $request->type,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'user_id' => Auth::user()->id,
                'additional' => $request->additional,
               /* 'phone' => $request->phone,
                'name' => Auth::user()->fullname,
                'email' => Auth::user()->email,
                'username' => Auth::user()->username, */
                'status' => 'active',
                'slug' => $slug
               ]);

              if($role1 = $request->role1){
                    $this->store_member($role1, $request->function_1, $request_team);
                }if($role2 = $request->role2){
                    $this->store_member($role2, $request->function_2, $request_team);
                }if($role3 = $request->role3){
                    $this->store_member($role3, $request->function_3, $request_team);
                }if($role4 = $request->role4){
                    $this->store_member($role4, $request->function_4, $request_team);
                }
                $user = Auth::user();
                
                 \Mail::to($user)->send(new RequestTeamup($user));
                session()->flash('message', 'Request Submitted, you will be contacted soon!');
              return redirect('/dashboard#');
        }

    }

    public function store_member($therole, $thefunction, $request_team) {
            $request_member = RequestMember::create([
                'role' => $therole,
                'function' => $thefunction,
                'team_request_id' => $request_team->id
               ]);
        } 

    public function show($slug)
    {
         $request = TeamRequest::where('slug', $slug)->first();
         if($request) {
             if( (Auth::check()) AND ($request->user->username == Auth::user()->username) ) {
                 $request = TeamRequest::where('slug', $slug)->where('status', 'active')->orWhere('status', 'deactivated')->first();
             }else{
                 $request = TeamRequest::where('slug', $slug)->where('status', 'active')->first();
             }
            return view('team_requests/show', compact('request'));
        }else{
            session()->flash('error', 'No such team request!');
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        $request_team = TeamRequest::where('slug', $slug)->first();
        if($find->username == Auth::user()->username) {
            return view('team_requests/edit', compact('request_team'));
        }else {
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $slug)
    {

        $request_team = TeamRequest::where('slug', $slug)->first();
        $request_team->status = $request->status;
        $request_team->save();
        $slug = $request_team->slug;
        session()->flash('message', 'Requested Position Updated!');
        return redirect('/request_team/'.$slug);
    }

    public function destroy($id)
    {
        //
    }
}

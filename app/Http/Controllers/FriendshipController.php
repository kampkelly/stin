<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Startup;
use App\Category;
use App\StartupsPhoto;
use App\Friendship;
use App\FriendFriendshipGroups;
use LRedis;
use App\Events\AcceptConnection;
use App\Events\SendConnection;

class FriendshipController extends Controller
{
   

    public function addfriend($username)
    {
        $user = User::where('username', $username)->first();
        $auth = Auth::user();
        if($user->id != Auth::user()->id){
        Auth::user()->befriend($user);
        $receiver_request_id = $user->id;
        if(count( $user->getFriendRequests() ) >= 1){
            $request_id = 1;
        }else{
            $request_id = 0;
        }
        $data = ['request_id' => $request_id, 'receiver_request_id' => $receiver_request_id, 'fullname' => Auth::user()->fullname, 'username' => Auth::user()->username];
        event(new SendConnection($user, $auth));
        return 'Connection request sent!';
        }else{
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    } 
 
    public function acceptfriend($username)
    {
        $user = User::where('username', $username)->first();
        $auth = Auth::user();
        if($user->id != Auth::user()->id){
        Auth::user()->acceptFriendRequest($user, $auth);
        event(new AcceptConnection($user, $auth));
        return 'Connection request accepted!';
        }else{
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    }  

    public function rejectfriend($username)
    {
        $user = User::where('username', $username)->first();
        if($user->id != Auth::user()->id){
        Auth::user()->denyFriendRequest($user);
        return 'Connection request rejected!';
        }else{
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    } 

    public function unfollowfriend($username)
    {
        $user = User::where('username', $username)->first();
        if($user->id != Auth::user()->id){
            Auth::user()->unfriend($user);
        return 'Friend unfollowed';
        }else{
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    } 

    public function blockfriend($username)
    {
        $user = User::where('username', $username)->first();
        if($user->id != Auth::user()->id){
        Auth::user()->blockFriend($user);
        return 'Friend blocked';
        }else{
            session()->flash('message', 'Unauthorized Operation!');
            return redirect()->back();
        }
    } 

}

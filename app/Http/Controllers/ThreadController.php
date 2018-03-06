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
use App\Thread;
use App\Message;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;
use Image;
//use LRedis;
use App\Events\NewThreadMessage;
use App\Mail\NewMessage;
use App\Http\Controllers\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['firevent', 'sendevent']]);
    }

    public function store(Request $request)
    {
         $this->validate(request(), [
           'title' => 'required',
            'message' => 'required'
        ]); 

        $slug_title = request('title');
        $slug_date = date("Y-m-d");
        $slug_combine = $slug_title.' '.$slug_date;
        $slug_format = strtr($slug_combine, ' ', '-');
        $slug = $slug_format;
        //
    $receive_id = request('user_id');
       $thread = Thread::create([
            'title' => request('title'),
            'user_id' => Auth::user()->id,
            'sender_id' => Auth::user()->id,
            'receiver_id' => request('user_id'),
            'slug' => $slug
        ]);
       $message = Message::create([
            'body' => request('message'),
            'user_id' => Auth::user()->id,
            'thread_id' => $thread->id
        ]);
       $receiver = User::find($receive_id);
       $sender = Auth::user();
       \Mail::to($receiver)->send(new NewMessage($sender, $receiver));
        session()->flash('message', 'Thread Created, view in messages');
        return redirect('/dashboard#/'.Auth::user()->username.'/threads');
    }

 
    public function update(Request $request, $username, $slug)
    {
        $user = User::where('username', $username)->first();  //sender ==  authenticated user
        $thread = Thread::where('slug', $slug)->first();
       $message = Message::create([
            'body' => request('message'),
            'user_id' => request('user_id'),
            'thread_id' => request('thread_id')
        ]);
        $data = ['auth_id' => Auth::user()->id, 'user_id' => $user->id, 'body' => request('message'), 'thread_id' => request('thread_id'), 'created_at' => $message->created_at, 'username' => Auth::user()->username, 'fullname' => Auth::user()->fullname];
        $message = 'gameboy';
        event(new NewThreadMessage($data));
        if(Auth::user()->id == $thread->sender_id) { //1 == 1
            $sender = User::find($thread->sender_id);
            $receiver = User::find($thread->receiver_id);
        }else{
             $sender = User::find($thread->receiver_id);
             $receiver = User::find($thread->sender_id);
        }
        \Mail::to($receiver)->send(new NewMessage($sender, $receiver)); 
        return 'Message Sent';
    }

    public function messenger()
    {
     //   $thread = DB::select("SELECT * FROM threads WHERE (user_id = '".Auth::user()->id."' AND receiver_id = '".$user->id."') OR (user_id = '".$user->id."' AND receiver_id = '".Auth::user()->id."') Order BY id desc");
        $auth = Auth::user();
         $users = User::all();
        $userfriends = Auth::user()->getFriends();
        $allthreads = \App\Thread::where('user_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->get();
        $threads = [];
        $messages = [];
            foreach ($allthreads as $tr) {
                $mess = $tr->messages()->orderBy('id', 'asc')->get();
                if(count($mess) >= 1) {
                    array_push($threads, $tr);
                    foreach ($mess as $msg) {
                         array_push($messages, $msg);
                    }
                }
            }
           // $messages = $threads->messages()->orderBy('id', 'asc')->get();
            $data = [$userfriends, $threads, $auth, $messages];
            return $data;
          //  $view->with(compact('userfriends', 'threads')); 
    }

    public function destroy($id)
    {
        //
    }
}

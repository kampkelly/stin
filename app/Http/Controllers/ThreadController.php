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
use App\Mail\Welcome;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;
use Image;
//use LRedis;
use App\Events\NewThreadMessage;

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
    $receiver_id = User::find($receive_id);
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
        session()->flash('message', 'Thread Created, view in messages');
        return redirect('/dashboard#/'.Auth::user()->username.'/threads');
    }

 
    public function update(Request $request, $username, $slug)
    {
        $user = User::where('username', $username)->first();
        $thread = Thread::where('slug', $slug)->first();
       $message = Message::create([
            'body' => request('message'),
            'user_id' => request('user_id'),
            'thread_id' => request('thread_id')
        ]);
        $data = ['auth_id' => Auth::user()->id, 'user_id' => $user->id, 'body' => request('message'), 'thread_id' => request('thread_id'), 'created_at' => $message->created_at, 'username' => Auth::user()->username];
        $message = 'gameboy';
        event(new NewThreadMessage($data));
        return 'Message Sent';
    }

    public function destroy($id)
    {
        //
    }
}

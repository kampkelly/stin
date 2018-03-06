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
use App\Post;
use App\Mail\Welcome;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
       # $this->middleware('guest', ['except' => ['index']]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
           'post_title' => 'required',
            'body' => 'required'
        ]); 

        $slug_title = request('post_title');
        $slug_date = date("Y-m-d");
        $slug_combine = $slug_title.' '.$slug_date;
        $slug_format = strtr($slug_combine, ' ', '-');
        $slug = $slug_format;
        //
       $post = Post::create([
            'title' => request('post_title'),
            'body' => request('body'),
            'username' => Auth::user()->username,
            'user_id' => Auth::user()->id,
            'slug' => $slug
        ]);
       session()->flash('message', 'News Created'); //THEN INCLUDE IN THE REDIRECTED FUNCTION, HERE ITS "SHOW"
        return redirect()->back();
     //   return redirect('/news');
    }

    public function edit($slug)
    {
        $news = Post::where('slug', $slug)->first();
        return view('posts.edit', compact('news'));
    }

    public function update(Request $request, $slug)
    {
         $this->validate(request(), [
           'post_title' => 'required|min:8'
        //    'body' => 'required'
        ]); 

        $news = Post::where('slug', $slug)->first();
        $slug_title = request('post_title');
        $slug_date = date("Y-m-d");
        $slug_combine = $slug_title.' '.$slug_date;
        $slug_format = strtr($slug_combine, ' ', '-');
        $slug = $slug_format;

      //  $news = Post::find();
        if (Input::has('post_title')) $news->title = Input::get('post_title');
        if (Input::has('body')) $news->body = Input::get('body');
        $news->slug = $slug;
        $news->username = Auth::user()->username;
        $news->user_id = Auth::user()->id;
        $news->save();
       // return redirect('/news');
        session()->flash('message', 'News Updated'); //THEN INCLUDE IN THE REDIRECTED FUNCTION, HERE ITS "SHOW"
        return redirect()->back();
    }

    public function destroy($slug)
    {
        $deleted = Post::where('slug', $slug)->first();
        $deleted->delete();
        session()->flash('message', 'News Deleted!');
        return redirect()->back();
    }
}

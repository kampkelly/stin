<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function store(Request $request)
    {

         Comment::create([
            'comment' => request('comment'),
            'name' => request('comment_name'),
            'startup_id' => request('startup_id'),
            'user_id' => Auth::user()->id
        ]);
        $id = request('startup_id');
        session()->flash('message', 'Commented successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $deleted = Comment::find($id);
        $deleted->delete();
        $id = request('startup_id');
        session()->flash('message', 'Comment Deleted!');
        return redirect()->back();
    }
}

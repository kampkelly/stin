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

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
       # $this->middleware('guest', ['except' => ['index']]);
    }

    public function all_innovations()
    {
    	$innovations = Startup::orderBy('id', 'desc')->paginate(40);
        return view('admin.all_innovations', compact('innovations'));
    }

    public function approved_innovations()
    {
    	$innovations = Startup::where('status', 'approved')->orderBy('id', 'desc')->paginate(40);
        return view('admin.approved_innovations', compact('innovations'));
    }

    public function pending_innovations()
    {
    	$innovations = Startup::where('status', 'pending')->orderBy('id', 'desc')->paginate(40);
        return view('admin.pending_innovations', compact('innovations'));
    }

    public function declined_innovations()
    {
    	$innovations = Startup::where('status', 'declined')->orderBy('id', 'desc')->paginate(40);
        return view('admin.declined_innovations', compact('innovations'));
    }

    public function categories()
    {
    	$categories = Category::orderBy('id', 'desc')->paginate(40);
        return view('admin.categories', compact('categories'));
    }

    public function innovators()
    {
        if(checkPermission(['admin', 'superadmin'])) {
    	$users = User::where('is_permission', 0)->orderBy('id', 'desc')->paginate(40);
        return view('admin.innovators', compact('users'));
        }else{
            return 'Wrong';
        }
    }

    public function investors()
    {
    	$users = User::where('is_permission', 1)->orderBy('id', 'desc')->paginate(40);
        return view('admin.investors', compact('users'));
    }

    public function blocked_users()
    {
    	$users = User::where('status', 'blocked')->orderBy('id', 'desc')->paginate(40);
        return view('admin.blocked_users', compact('users'));
    }

    public function admin_users()
    {
    	$users = User::where('is_permission', 4)->orWhere('is_permission', 5)->orderBy('id', 'desc')->paginate(40);
        return view('admin.admin_users', compact('users'));
    }

    public function innovator_hold($username)
    {
    	$user = User::where('username', $username)->first();
    	$user->status = 'hold';
    	$user->save();
    	return redirect()->back();
    } 

    public function innovator_block($username)
    {
    	$user = User::where('username', $username)->first();
    	$user->status = 'blocked';
    	$user->save();
    	return redirect()->back();
    } 

    public function innovator_approve($username)
    {
    	$user = User::where('username', $username)->first();
    	$user->status = 'approved';
    	$user->save();
    	return redirect()->back();
    } 

    public function innovation_approve($slug)
    {
    	$innovation = Startup::where('slug', $slug)->first();
    	$innovation->status = 'approved';
    	$innovation->save();
    	return redirect()->back();
    }

    public function innovation_decline($slug)
    {
    	$innovation = Startup::where('slug', $slug)->first();
    	$innovation->status = 'declined';
    	$innovation->save();
    	return redirect()->back();
    }

    public function subscribed()
    {
        $users = User::orderBy('id', 'desc')->paginate(40);
        return view('admin.subscribed', compact('users'));
    }

    public function posts()
        {
           if(checkPermission(['admin', 'superadmin'])) {
                $posts = Post::orderBy('id', 'desc')->paginate(40);
                return view('admin.posts', compact('posts'));
            }else{
                return 'Invalid Input';
            }
        }

    public function change_role(Request $request)
    {
        $id = request('admin_id');
        $admin = User::find($id);
        $admin->is_permission = $request->new_role;
        $admin->save();
        session()->flash('message', 'Admin Role Changed!'); 
         return redirect()->back();
    }

}

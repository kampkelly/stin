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
use App\TeamRequest;
use App\Message; 
use App\Mail\Welcome;
use Carbon\Carbon;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;

class LteAdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
       # $this->middleware('guest', ['except' => ['index']]);
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subDay(7))->take(8)->get();
        $countusers = User::orderBy('id', 'desc')->count();
    	$countmessages = Message::orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subDay(31))->count();
    	$count_recent_users = User::orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subDay(7))->count();
    	$innovations = Startup::orderBy('id', 'desc')->paginate(5);
    	$teamrequests = TeamRequest::orderBy('id', 'desc')->paginate(5);
    	//$retval = system('ls', $retval);  //output command to browser directly
    	//$retval = popen("ls", "r");  //run command in read mode
    	$retval = `python script.py`;  //run python script and save to variable
    	//$retval = exec('python script.py');  //run python script and save to variable
        return view('lte_admin/home', compact('innovations', 'users', 'teamrequests', 'count_recent_users', 'retval', 'countusers', 'countmessages'));
    }

     public function innovations()
    {
    	$users = User::orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subDay(7))->take(8)->get();
    	$count_allinnovations = Startup::orderBy('id', 'asc')->count();
    	$count_approvedinnovations = Startup::orderBy('id', 'asc')->where('status', '=', 'approved')->count();
    	$count_pendinginnovations = Startup::orderBy('id', 'asc')->where('status', '=', 'pending')->count();
    	$count_declinedinnovations = Startup::orderBy('id', 'asc')->where('status', '=', 'declined')->count();
    	$innovations = Startup::orderBy('id', 'desc')->paginate(20);
    	$approved_innovations = Startup::orderBy('id', 'desc')->where('status', '=', 'approved')->Simplepaginate(5);
    	$pending_innovations = Startup::orderBy('id', 'desc')->where('status', '=', 'pending')->Simplepaginate(5);
    	$declined_innovations = Startup::orderBy('id', 'desc')->where('status', '=', 'declined')->Simplepaginate(5);
        return view('lte_admin/innovations/index', compact('innovations', 'approved_innovations', 'pending_innovations', 'declined_innovations', 'count_allinnovations', 'count_approvedinnovations', 'count_pendinginnovations', 'count_declinedinnovations'));
    }

     public function categories()
    {
    	$count_categories = Category::orderBy('id', 'asc')->count();
    	$categories = Category::orderBy('id', 'desc')->Simplepaginate(10);
        return view('lte_admin/categories/index', compact('count_categories', 'categories'));
    }

     public function users()
    {
    	$count_admins = User::orderBy('id', 'asc')->where('is_permission', '=', 4)->orWhere('is_permission', '=', 5)->count();
    	$count_users = User::orderBy('id', 'asc')->where('is_permission', '=', 0)->count();
    	$users = User::orderBy('id', 'desc')->where('is_permission', '=', 0)->Simplepaginate(50);
    	$admins = User::orderBy('id', 'desc')->where('is_permission', '=', 4)->orWhere('is_permission', '=', 5)->Simplepaginate(10);
        return view('lte_admin/users/index', compact('count_users', 'users', 'admins', 'count_admins'));
    }

     public function news()
    {
    	$count_news = Post::orderBy('id', 'asc')->count();
    	$news = Post::orderBy('id', 'desc')->Simplepaginate(50);
        return view('lte_admin/news/index', compact('count_news', 'news'));
    }
}

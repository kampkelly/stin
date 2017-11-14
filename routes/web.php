<?php
/*Web Routes*/
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Auth::routes();

  Route::get('/in', 'HomeController@authenticate');
  Route::post('/getnotified', 'HomeController@getnotified');

Route::get('/launchingsoon', function () {
    return view('launchingsoon');
});

Route::get('/sitemap', function () {
    return view('sitemap');
});

Route::get('/contact', function () {
    return view('contact');
}); 

/*Route::get('/', function () {
    return view('home');
}); */
Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');
Route::get('/innovations/briefing', 'StartupController@briefing');
Route::get('/request_team', function () {
    return view('team_requests/request');
}); 
Route::post('/request_team', 'TeamRequestController@store');
Route::post('/request_team/update/{slug}', 'TeamRequestController@update');
Route::get('/team_requests', 'TeamRequestController@index');
Route::get('/myrequests', 'TeamRequestController@mine');
Route::get('/request_team/{slug}', 'TeamRequestController@show');
Route::get('/request_team/update/{slug}', 'TeamRequestController@edit');

//check auth for request teamup
  Route::post('/checkauth', function(){
    if(Auth::check()) {
      $auth = 1;
    }else {
      $auth = 0;
    }
    return $auth;
  });
//check auth for request teamup
//real spa routes begins//////////////////////////////////////////////////////////
Route::group(['middleware'=>'auth'], function () {

  Route::get('/dashboard', function () {
      return view('homespa');
  });

  Route::post('/categories', function(){
    return App\Category::with('startups')->inRandomOrder()->get();
  });

  Route::post('/categories_dashboard', function(){
    return App\Category::with('startups')->orderBy('id', 'desc')->get();
  });

  Route::post('/innovations', function(){
    $innovations = App\Startup::where('status', 'pending')->orWhere('status', 'approved')->with('user')->orderBy('id', 'desc')->get();
    $suggestions = App\User::where('is_permission', '!=', 4)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(15)->get();
    $thedata = [$innovations, $suggestions];
    return $thedata;
  });

  Route::post('/showcategory/{id}', function($id){
    $category = App\Category::find($id);
    $startups = $category->startups()->where('status', 'pending')->with('user')->orderBy('id', 'desc')->get();
    $thedata = [$category, $startups];
    return $thedata;
  });

  Route::post('/innovation/{slug}', function($slug){
    $startup = App\Startup::where('slug', $slug)->with('user')->first();
    $comments = $startup->comments()->orderBy('id', 'desc')->get();
    $startupsphotos = $startup->startupsphotos()->orderBy('id', 'asc')->get();
    $youtubevideos = $startup->youtubevideos()->where('user_id', $startup->user->id)->orderBy('id', 'desc')->get();
    $user = Auth::user();
    $thedata = [$startup, $comments, $startupsphotos, $youtubevideos, $user];
    return $thedata;
  });

  Route::post('/showconnections', function(){
   // $this_user = User::where('username', $username)->first();
    $this_user = Auth::user();
    $user_for_friends = User::where('is_permission', '!=', 4)->where('is_permission', '!=', 5)->where('id', '!=', Auth::user()->id)->inRandomOrder()->get();
    $friends = $this_user->getFriends();
    $requests = $this_user->getFriendRequests();
    $all_users = User::all();
    $thedata = [$friends, $user_for_friends, $requests, $all_users];
   // $thedata = list($min, $max);
    return $thedata;
  });

  Route::post('/my-feeds/username', function(){
    $friends = Auth::user()->getFriends();
    $startups = App\Startup::where('status', 'pending')->orWhere('status', 'approved')->orderBy('id', 'desc')->get();
    $username = Auth::user()->username;
    $thedata = [$friends, $startups, $username];
    return $thedata;
  });

  Route::post('/innovator/edit', function(){
    $user = Auth::user();
    $startups = App\Startup::where('status', 'pending')->orderBy('id', 'desc')->simplePaginate(1); 
    $countries = DB::select("SELECT * FROM countries Order BY id asc");
    $thedata = [$user, $startups, $countries];
    return $thedata;
  });

   Route::post('/getposts', function(){
    $posts = App\Post::orderBy('id', 'desc')->get();
    return $posts;
  }); 

  Route::post('/post/{slug}', function($slug){
    $post = App\Post::where('slug', $slug)->first();
    return $post;
  });

  Route::post('/{username}/threads', function($username){
    $user = App\User::where('username', $username)->first();
    if(Auth::user()->id == $user->id) {
        $threads = App\Thread::where('user_id', $user->id)->orWhere('receiver_id', $user->id)->orderBy('id', 'desc')->with('user')->get(); 
        $auth = Auth::user();
        $users = App\User::all();
        $thedata = [$threads, $auth, $users];
        return $thedata;
    }else{
      $threads = [];
      return $threads;
    }
  });

  Route::post('/thisthread/{username}/{slug}', function($username, $slug){
    $user = App\User::where('username', $username)->first();
      $thread = DB::select("SELECT * FROM threads WHERE (user_id = '".Auth::user()->id."' AND receiver_id = '".$user->id."' AND slug = '".$slug."') OR (user_id = '".$user->id."' AND receiver_id = '".Auth::user()->id."' AND slug = '".$slug."') Order BY id desc");
       if(count($thread) >= 1) {
            $thread = App\Thread::where('slug', $slug)->first();
            $messages = $thread->messages()->orderBy('id', 'asc')->get();
            $auth = Auth::user();
            $thedata = [$thread, $messages, $user, $auth];
            return $thedata;
        }else{
            $thedata = [];
            return $thedata;
        } 
  });

  Route::post('/list-items', function(){
    $auth = Auth::user();
    return $auth;
  });
  
  Route::post('/myprofile/{username}', 'PersonController@myprofile');
  Route::post('/person/{username}', 'PersonController@myinnovations');
  Route::post('/innovation/edit/{slug}', 'StartupController@edit');
  Route::post('/innovation/new/save', 'StartupController@store');
  Route::post('/innovation/update/{slug}', 'StartupController@update');
  Route::post('/newsearch/{query}', 'StartupController@newsearch');

});

//real spa routes ends//////////////////////////////////////////////////////////


Route::get('/features', function () {
    return view('features');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/disclaimer', function () {
    return view('disclaimer');
});
Route::get('/security', function () {
    return view('security');
});
Route::get('/privacy', function () {
    return view('privacy');
});
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/fileuploaderror', function () {
    return view('filebig');
});


Route::group(['middleware'=>'auth'], function () {
	Route::get('permissions-all-users',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
	Route::get('permissions-admin-superadmin',['middleware'=>'check-permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
	Route::get('permissions-superadmin',['middleware'=>'check-permission:superadmin','uses'=>'HomeController@superadmin']);
});

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboardold', 'StartupController@index');
Route::get('/startups', 'StartupController@startups');
Route::get('/show', 'StartupController@start');
Route::get('/startup/new', 'StartupController@create');
Route::post('/create_startups', 'StartupController@store');
Route::get('/startup/{slug}', 'StartupController@show');
Route::get('/startup/edit/{slug}', 'StartupController@edit');
Route::post('/startup/{slug}', 'StartupController@update');
Route::post('/startup/{slug}/photo_added', 'StartupController@startupsphotoupdate');
Route::post('/startup/{id}/image-deleted', 'StartupsPhotoController@destroy');


Route::post('/categories', 'CategoryController@store');
Route::get('/category/{show}', 'CategoryController@show');

Route::post('/category/{id}', 'CategoryController@update');
Route::post('/category', function(){
   $id = Input::get('category_id');    
  # return Redirect::action('FrontController@buscarPrd', array('nom'=>$bsqd));
  // return redirect('/category/'.$id);
   return redirect('/dashboard#/category/'.$id);

});
Route::any('/search', 'StartupController@search');
Route::any('/advanced_search', 'StartupController@advancedsearch');
Route::post('/contact', 'HomeController@sendcontact');

//youtube video upload
Route::post('/videos', 'YoutubeVideosController@video');
// Route::post('/startup/video-deleted', 'YoutubevideosController@dt');
Route::post('/video/delete', 'YoutubeVideosController@destroy');
//youtube video upload
//comments
Route::post('/startup/{id}/comments', 'CommentsController@store');
Route::delete('/comment/{delete}', 'CommentsController@destroy');
//comments

//Friendships Begins
Route::post('/connect/{username}/{message}', 'FriendshipController@addfriend');
Route::post('/accept_request/{username}', 'FriendshipController@acceptfriend');
Route::post('/reject_request/{username}', 'FriendshipController@rejectfriend');
Route::post('/unconnect_friend/{username}', 'FriendshipController@unfollowfriend');
Route::post('/block_friend/{username}', 'FriendshipController@blockfriend');
//Route::get('/{username}/connections', 'FriendshipController@showfriends');
//Friendship Ends
//Route::get('/my-feeds/{username}', 'FriendshipController@myfeeds');

//BRAINTREE
// Route::get('/plans', 'PlansController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/plans', 'PlansController@index');
    Route::get('/plan/{plan}', 'PlansController@show');
    Route::get('/braintree/token', 'BraintreeTokenController@token');
    Route::post('/subscribe', 'SubscriptionsController@store');
    //middleware subscribe
    Route::group(['middleware' => 'subscribed'], function () {
        Route::get('/lessons', 'LessonsController@index');
        Route::get('/subscriptions', 'SubscriptionsController@index');
        Route::post('/subscription/cancel', 'SubscriptionsController@cancel');
        Route::post('/subscription/resume', 'SubscriptionsController@resume');
    });
});

Route::post(
    'braintree/webhooks',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

//BRAINTREE
//verify
Route::get('/toverify_email', function () {
  //  Route::group(['middleware' => 'guest'], function () {
    //    if(Request::url() === 'http://www.theinnovestors.dev/innovator/register'){
          //  Route::get('/toverify_email', 'VerificationController@toverify_email');
            return view('auth/toverify_email');
      //  }else{
           // Route::get('/toverify_email', 'Auth\RegisterController@investor_profile');
        //    dd('invalid request');
        //}
  //  });
});
Route::get('/verifyemail/{token}/{username}', 'VerificationController@verify');

//verify
//INNOVATOR
//Route::get('/innovator/profile/{username}', 'StartupController@innovator_profile');
//Route::get('/innovator/profile/edit/{username}', 'StartupController@innovator_profile_edit');
Route::post('/upload_profile_pic', 'StartupController@upload_profile_pic');
//INVESTOR
Route::get('/investor/profile/{username}', 'PersonController@investor_profile');
Route::get('/investor/profile/edit/{username}', 'PersonController@investor_profile_edit');


Route::post('/profile/image/{username}', 'PersonController@pic_update');
//Route::get('/innovator/profile/edit/{id}', 'StartupController@innovator_profile_edit');function(){

$this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//$this->post('login', 'Auth\LoginController@login');
/*Route::post('login',function(){
    $username = Input::get('email');
    $user = User::where('username', $username)->first();
   // $email = Input::get('email');
    if($username == $user->username OR $username == $user->email){
      //  array(
       // 'as' => 'login',
        'uses' => 'Auth\LoginController@Login'
     //   );
    }else{
        dd('not verified!');
    }
});
Route::post('login', array(
        'as' => 'login',
        'uses' => function () {
            $username = Input::get('email');
            $user = User::where('username', $username)->first();
           // $email = Input::get('email');
            if($username == $user->username OR $username == $user->email){
          //  'Auth\LoginController@Login'
            return redirect()->action('Auth\LoginController@login');
        }else{
            dd('not verified!');
        }
    }
       // 'Auth\LoginController@Login'
)); */

$this->post('login', 'Auth\LoginController@login');
$this->post('/test_ajax', 'Auth\LoginController@test_ajax');
//$this->post('login', 'LognController@autheicate');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('signup', 'Auth\RegisterController@signup')->name('signup');
$this->get('innovator/register', 'Auth\RegisterController@innovator')->name('register');
#$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->get('investor/register', 'Auth\RegisterController@investor')->name('register');
$this->post('/innovator/register', 'Auth\RegisterController@signupinnovator');
$this->post('/innovator/update/{id}', 'StartupController@postinnovator_update');
#$this->post('register', 'Auth\RegisterController@register');
$this->post('/investor/register', 'Auth\RegisterController@postinvestor');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

//admin
Route::get('/toverify_email', function () {
 
});
Route::group(['middleware' => 'check-permission:admin|superadmin'], function () {
  Route::get('/admin/all_innovations', 'AdminController@all_innovations');
  Route::get('/admin/approved_innovations', 'AdminController@approved_innovations');
  Route::get('/admin/pending_innovations', 'AdminController@pending_innovations');
  Route::get('/admin/declined_innovations', 'AdminController@declined_innovations');
  Route::get('/admin/categories', 'AdminController@categories');
  Route::get('/admin/category/new', 'CategoryController@create');
  Route::get('/admin/category/edit/{edit}', 'CategoryController@edit');
  Route::get('/admin/innovators', 'AdminController@innovators');
  Route::get('/admin/investors', 'AdminController@investors');
  Route::get('/admin/blocked_users', 'AdminController@blocked_users');
  Route::get('/admin/admin_users', 'AdminController@admin_users');
  Route::get('/admin/innovations/approve/{slug}', 'AdminController@innovation_approve');
  Route::get('/admin/innovations/decline/{slug}', 'AdminController@innovation_decline');
  Route::get('/admin/innovators/hold/{username}', 'AdminController@innovator_hold');
  Route::get('/admin/innovators/block/{username}', 'AdminController@innovator_block');
  Route::get('/admin/innovators/approve/{username}', 'AdminController@innovator_approve');
  Route::get('/admin/users/subscribed', 'AdminController@subscribed');

  //Posts
 // Route::get('/news', 'PostController@index');
  Route::get('/admin/post/new', 'PostController@create');
  Route::post('/admin/posts', 'PostController@store');
 // Route::get('/news/{slug}', 'PostController@show');
  Route::get('/admin/post/edit/{slug}', 'PostController@edit');
  Route::post('/admin/post/{slug}', 'PostController@update');
  Route::get('/admin/post/delete/{slug}', 'PostController@destroy');
  Route::get('/admin/posts', 'AdminController@posts');
  Route::post('/change_admin_role', 'AdminController@change_role');
  //categories
  Route::get('/category/new', 'CategoryController@create');
  Route::post('/create_categories', 'CategoryController@create');
  Route::get('/category/remove/{remove}', 'CategoryController@destroy');
  Route::get('/category/edit/{edit}', 'CategoryController@edit');
});
//message
Route::post('/messages', 'ThreadController@store');
//Route::get('/threads/{username}/{slug}', 'ThreadController@show');
Route::post('/threads/{username}/{slug}', 'ThreadController@update');
//Route::get('{username}/threads', 'ThreadController@index');
//message

Route::get('/socket', 'SocketController@index');
Route::post('/sendmessage', 'SocketController@sendMessage');
Route::get('/writemessage', 'SocketController@writemessage');
Route::get('/sendevent', 'ThreadController@sendevent');

//admin

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//Route::get('auth/{provider}/callback', 'VerificationController@handleProviderCallback');

/*Route::group(['middleware'=>'guest'], function () {
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
}); */


//connect google
Route::get('connect/{provider}', 'Auth\LoginController@redirectToProvider');
//Route::get('connect/{provider}/callback', 'VerificationController@handleProviderCallback');




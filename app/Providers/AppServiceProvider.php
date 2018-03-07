<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree_Configuration;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Thread;
use App\Message;
use App\Post;
use App\Category;
use App\Friendship;
//use Hootlex\Friendships\Models\Friendship;
use App\FriendFriendshipGroups;
use App\TeamRequest;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    /*  if($this->app->environment('production')) {
          URL::forceSchema('https');
      } */
      Schema::defaultStringLength(191);
        //'status', '=', 'pending'
        //FOR GLOBAL VIEW EVERYWHERE
        view()->composer('/partials/sidebar', function ($view) {
           // $friends = Auth::user()->getAcceptedFriendships();
            $news = \App\Post::orderBy('id', 'desc')->paginate(40);
            $friends = Auth::user()->getFriends($perPage = 20);
            $user_for_friends = User::where('is_permission', '!=', 4)->where('is_permission', '!=', 5)->where('is_permission', '!=', 1)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(3)->get();
            $investors = User::where('is_permission', '=', 1)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(30)->get();
            $categories = \App\Category::orderBy('id', 'desc')->get();
          #  $categories = \App\Category::has('startups')->get();
            $startsides = \App\Startup::where('status', 'pending')->orWhere('status', 'approved')->orderBy('id', 'desc')->take(5)->get();
            $request_teams = \App\TeamRequest::where('status', 'active')->orderBy('id', 'desc')->take(5)->get();
           # $tags = \App\Tag::has('posts')->pluck('name');
            $view->with(compact('categories', 'startsides', 'friends', 'user_for_friends', 'investors', 'news', 'request_teams'));
            });    

        view()->composer('/partials/left_sidebar', function ($view) {
           // $friends = Auth::user()->getAcceptedFriendships();
            $friends = Auth::user()->getFriends($perPage = 20);
            $user_for_friends = User::all();
            $categories = \App\Category::all();
          #  $categories = \App\Category::has('startups')->get();
            $startsides = \App\Startup::where('status', 'pending')->orderBy('id', 'desc')->take(5)->get();
           # $tags = \App\Tag::has('posts')->pluck('name');
            $view->with(compact('categories', 'startsides', 'friends', 'user_for_friends'));
            });     

        view()->composer('/partials/suggestions', function ($view) {
           // $friends = Auth::user()->getAcceptedFriendships();
            $suggestions = User::where('is_permission', '!=', 4)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(15)->get();
            $view->with(compact('suggestions'));
            });    

        view()->composer('/partials/_messenger', function ($view) {
            $users = User::all();
            $userfriends = Auth::user()->getFriends();
            $allthreads = \App\Thread::where('user_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->get();
            $threads = [];
            foreach ($allthreads as $tr) {
                $mess = $tr->messages()->orderBy('id', 'asc')->get();
                if(count($mess) >= 1) {
                    array_push($threads, $tr);
                }
            }
           // $messages = $threads->messages()->orderBy('id', 'asc')->get();
            $view->with(compact('userfriends', 'threads')); 
            });  

//////for admin begins
          view()->composer('lte_admin/partials/_left_sidebar', function ($view) {
            $countusers = User::count();
            $countnews = Post::count();
            $countcategories = Category::count();
            $countinnovations = \App\Startup::orderBy('id', 'asc')->count();
            $count_teamrequests = \App\TeamRequest::orderBy('id', 'asc')->count();
            $view->with(compact('countusers', 'countinnovations', 'count_teamrequests', 'countnews', 'countcategories')); 
            });    

//////for admin ends
        
        //BRAINTREE
        Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
        // Cashier::useCurrency('eur', '€');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}

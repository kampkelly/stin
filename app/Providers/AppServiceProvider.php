<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree_Configuration;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Friendship;
use App\FriendFriendshipGroups;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //'status', '=', 'pending'
        //FOR GLOBAL VIEW EVERYWHERE
        view()->composer('/partials/sidebar', function ($view) {
           // $friends = Auth::user()->getAcceptedFriendships();
            $news = \App\Post::orderBy('id', 'desc')->paginate(40);
            $friends = Auth::user()->getFriends($perPage = 20);
            $user_for_friends = User::where('is_permission', '!=', 4)->where('is_permission', '!=', 1)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(3)->get();
            $investors = User::where('is_permission', '=', 1)->where('id', '!=', Auth::user()->id)->inRandomOrder()->take(30)->get();
            $categories = \App\Category::orderBy('id', 'desc')->get();
          #  $categories = \App\Category::has('startups')->get();
            $startsides = \App\Startup::where('status', 'pending')->orWhere('status', 'approved')->orderBy('id', 'desc')->take(5)->get();
           # $tags = \App\Tag::has('posts')->pluck('name');
            $view->with(compact('categories', 'startsides', 'friends', 'user_for_friends', 'investors', 'news'));
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

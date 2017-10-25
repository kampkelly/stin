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

class MessageController extends Controller
{
  
    public function destroy($id)
    {
        //
    }
}

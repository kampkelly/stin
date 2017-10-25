<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Dawson\Youtube\Facades\Youtube;
use App\YoutubeVideo;

class YoutubeVideosController extends Controller
{
  

    public function video(Request $request)
    {
        if(filesize(Input::file('video')) > 10000000){
            session()->flash('message', 'Image too big');
           // return redirect()->back();
            return redirect('/fileuploaderror');
        }else{

               $video = Youtube::upload(Input::file('video'), [
                'title' => request('title'),
                'description' => request('description')
            ]);  
               $youtubevideo = YoutubeVideo::create([
                    'user_id' => Auth::user()->id,
                    'startup_id' => request('startup_id'),
                    'video_id' => $video->getVideoId(),
                    'title' => request('title'),
                    'description' => request('description')
                ]); 
               // return 'done';
          //  return $video->getVideoId();
               session()->flash('message', 'Video Uploaded Successfully!');
            return redirect()->back();
        }
    }

    public function det() {
        return 'donee';
    }

    public function destroy(Request $request)
    {
        $video_id = request('video_id');
        $youtube_id = request('youtube_id');
        $video_deleted = YoutubeVideo::find($video_id); 
        $video_deleted->delete();
        Youtube::delete($youtube_id);
        session()->flash('message', 'Video Deleted');
        return redirect()->back();
    }

}

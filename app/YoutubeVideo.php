<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
	protected $fillable = ['user_id', 'startup_id', 'video_id', 'title', 'description'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function startup(){
        return $this->belongsTo(Startup::class);
    }

}

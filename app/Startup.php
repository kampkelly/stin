<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
	use Searchable;
    //
         protected $fillable = [
	        'title', 'group_name', 'short_desc', 'full_desc', 'image', 'aim', 'importance', 'achievements', 'features', 'category_id', 'user_id', 'contacts', 'status', 'slug'
	        ];

	        public function category(){
		        return $this->belongsTo(Category::class);
		    }

		    public function user(){
		        return $this->belongsTo(User::class)
		        ->select(['id', 'fullname', 'username']);
		    }

		    public function startupsphotos(){
		        return $this->hasMany(StartupsPhoto::class);
		    }

		    public function youtubevideos(){
		        return $this->hasMany(YoutubeVideo::class);
		    }

		    public function comments(){
		        return $this->hasMany(Comment::class);
		    }
}

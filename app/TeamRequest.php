<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamRequest extends Model
{
     protected $fillable = ['user_id', 'description', 'category', 'title', 'type', 'additional', 'status', 'slug'];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestmembers(){
        return $this->hasMany(RequestMember::class);
    }
}

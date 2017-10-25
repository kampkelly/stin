<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title', 'user_id', 'sender_id', 'receiver_id', 'slug'];

    public function messages(){
        return $this->hasMany(Message::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}

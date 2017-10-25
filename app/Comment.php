<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'comment', 'name', 'startup_id', 'user_id' ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}

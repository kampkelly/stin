<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartupsPhoto extends Model
{
     protected $fillable = ['startup_id', 'filename'];
 
    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
    
}

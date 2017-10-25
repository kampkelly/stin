<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [ 'name', 'description', 'image' ];

    public function startups(){
        return $this->hasMany(Startup::class);
    }
}

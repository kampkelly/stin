<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestMember extends Model
{
     protected $fillable = ['role', 'function', 'team_request_id'];

      public function teamrequest()
    {
        return $this->belongsTo(TeamRequest::class);
    }
}

<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'username', 'email', 'password', 'address', 'state', 'country', 'age', 'website', 'facebook', 'linkedin', 'twitter', 'bio', 'education', 'profession', 'interests', 'is_permission', 'gender', 'specialization', 'contacts', 'company_name', 'verified', 'verification_token', 'status', 'provider', 'provider_id'
    ];

    public function startups(){
        return $this->hasMany(Startup::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function youtubevideos(){
        return $this->hasMany(YoutubeVideo::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function findpartners(){
        return $this->hasMany(FindPartner::class);
    }

      public function getJWTIdentifier()
    {
        return $this->getKey();
    }
     public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

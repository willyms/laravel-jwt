<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Company extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * the attributes that are mass assignable
     */
    protected $fillable = ['name', 'email', 'website', 'logo', 'password', 'is_verified'];

    /**
     * the attributes that should be hidden for
     */
    protected $hidden = ['password'];

    protected $dates = ['deleted_at'];

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

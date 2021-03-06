<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Posts(){
        return $this->hasMany("App\Post", "user_id", "id");
    }

    public function userProfile($value = '')
    {
        return $this->hasOne("App\UserProfile", "user_id", "id");
    }

    public function generateToken()
    {
        $this->access_token = str_random(60);
        $this->save();

        return $this->access_token;
    }

}

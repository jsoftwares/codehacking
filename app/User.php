<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'photo_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo(('App\Photo'));
    }

    //User hasMany Posts
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function isAdmin()
    {
        if ($this->role->name == 'Administrator' && $this->status == 1) {
            return true;
        }
        return false;
    }

}

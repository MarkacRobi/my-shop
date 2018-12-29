<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'surname', 'phone', 'email', 'password', 'role' , 'status' ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //relacija, ki pomeni da ima user vec post-ov
    public function posts() {
        return $this->hasMany('App\Post');
    }

    //relacija, ki pomeni da ima user vec artiklov/item-ov
    public function items() {
        return $this->hasMany('App\Item');
    }
}

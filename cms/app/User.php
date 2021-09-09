<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mc_code','email', 'password','nickname', 'skill','profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
    
     // Postsテーブルとの多対多リレーション
     public function favo_posts() {
        return $this->belongsToMany('App\Post');
    }
    
    public function review() {
        return $this->hasMany('App\Review');
    }
}

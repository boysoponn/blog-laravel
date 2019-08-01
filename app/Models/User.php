<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password','remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_sign_in_at' => 'datetime',
    ];

    public function post(){
        return $this->hasMany('App\Models\Post','user_id');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment','user_id');
    }

    public function ban()
    {
        return $this->hasOne('App\Models\Ban','user_id');
    }
    
    public function getTimeCreateAttribute()
    {
        return $this->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL');
    }

    public function getTimeLastSignAttribute()
    {
        return $this->last_sign_in_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL');
    }
}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $grard = 'admin';
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'name', 'email', 'password','job_title'
    ];
    protected $casts = [
        'last_sign_in_at' => 'datetime',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}

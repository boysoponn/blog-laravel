<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ban extends Model
{
    use SoftDeletes;
    
    protected $table = 'ban';
    protected $primaryKey = 'ban_id';
    protected $fillable = [
        'user_id', 'description', 'cancel_at','admin_id','time'
    ];

    protected $casts = [
        'cancel_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','admin_id');
    }

    public function getLimit($value,$num)
    {
        return Str::limit($value,$num);
    }

    public function diffentTime($value)
    {
        return  $value->locale('th')->diffForHumans();
    }

    public function getTimeCreateAttribute()
    {
        return $this->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL');
    }

    public function getTimeCancel_atAttribute()
    {
        return $this->cancel_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL');
    }
}

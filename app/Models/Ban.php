<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ban extends Model
{
    use SoftDeletes;
    
    protected $table = 'ban';
    protected $primaryKey = 'ban_id';
    protected $fillable = [
        'user_id', 'description', 'cancel_at'
    ];

    protected $casts = [
        'cancel_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}

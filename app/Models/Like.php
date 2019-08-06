<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Like extends Model
{

    protected $table = 'like';
    protected $primaryKey = 'like_id';
    protected $fillable = [
        'user_id','likeable_id','likeable_type'
    ];
    protected static function boot() {
        parent::boot();
        Relation::morphMap([
            'post' => 'App\Models\Post',
            'comment' => 'App\Models\Comment',
        ]);
    }
    
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}

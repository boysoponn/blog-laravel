<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment','post_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
}

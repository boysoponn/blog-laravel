<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'post_id', 'user_id', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id');
    }
}

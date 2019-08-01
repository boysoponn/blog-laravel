<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Comment extends Model
{
    use SoftDeletes;

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
    public function getLimit($value,$num)
    {
        return Str::limit($value,$num);
    }

    public function getTimeCreateAttribute()
    {
        return $this->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL');
    }
}

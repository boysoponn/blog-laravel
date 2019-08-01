<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Post extends Model
{
    use SoftDeletes;
    
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

    public function upload()
    {
        return $this->belongsToMany('App\Models\Upload', 'posts_upload', 'post_id', 'upload_id'); 
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

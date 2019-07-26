<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;
    
    protected $table = 'upload';
    protected $primaryKey = 'upload_id';
    protected $fillable = [
        'user_id', 'name'
    ];
    public function upload()
    {
        return $this->belongsToMany('App\Models\Post', 'posts_upload', 'upload_id', 'post_id'); 
    }
}

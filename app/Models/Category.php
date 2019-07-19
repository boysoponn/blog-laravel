<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name','description'
    ];

    public function post()
    {
        return $this->hasMany('App\Models\Post','category_id');
    }

    public function comments()
    {
        return $this->hasManyThrough( 'App\Models\Comment','App\Models\Post', 'category_id' ,'post_id');
    }   

    public function lastPost()
    {
        return $this->hasOne('App\Models\Post','category_id')->orderBy('post_id', 'desc');
    }
}

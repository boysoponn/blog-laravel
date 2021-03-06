<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;
    
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
    
    public function getLimit($value,$num)
    {
        return Str::limit($value,$num);
    }

    public function diffentTime($value)
    {
        return  $value->locale('th')->diffForHumans();
    }
}

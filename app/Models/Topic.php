<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }
    //关联分类
    public function category(){
        return $this->belongsTo(Category::class);
    }
    //关联回复
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}

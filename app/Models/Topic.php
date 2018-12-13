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

    //根据参数排序
    public function scopeWithOrder($query, $order){
        if ($order == 'reply'){
            $query->orderBy('updated_at', 'desc');
        }else{
            $query->orderBy('created_at', 'desc');
        }
        return $query->with('user', 'category');
    }

}

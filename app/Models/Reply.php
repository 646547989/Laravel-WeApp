<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content'];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }
    //关联话题
    public function Topic(){
        return $this->belongsTo(Topic::class);
    }
}

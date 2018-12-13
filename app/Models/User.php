<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'intro', 'avatar', 'phone', 'weixin_openid', 'weixin_unionid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户授权判断是否有模型操作权限
    public function checkAuth($model){
        return $this->id == $model->user_id;
    }

    //关联话题
    public function topics(){
        return $this->hasMany(Topic::class);
    }
    //关联回复
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}

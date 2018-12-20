<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable{
        notify as protected laravelNotify;
    }
    use HasRoles;
    public function notify($instance)
    {
        //如果当前登录用户等于被通知的用户，直接返回不通知
        if ($this->id == \Auth::id()){
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function markAsRead(){
        $this->notification_count=0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
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

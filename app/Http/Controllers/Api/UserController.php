<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\UserRequest;
use App\Models\Image;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //用户注册
    public function store(UserRequest $request){
        //判断用户提交的验证key是否存在
        $verifyData=Cache::get($request->verification_keys);
        //判断验证码是否过期
        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }
        //判断输入验证码是否跟短信发送的验证码一致
        if (! hash_equals($verifyData['code'], $request->verification_code)){
            return $this->response->errorUnauthorized('验证码不正确');
        }

        //保存至数据库
        $user=User::create([
            'phone' => $verifyData['phone'],
            'name'  => $request->name,
            'password'  => Hash::make($request->password)
        ]);

        //删除验证码缓存
        Cache::forget($request->validatekey);
        return $this->response->item($user, new UserTransformer())->setMeta([
            'access_token' => \Auth::guard('api')->fromUser($user),
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }


    //获取个人信息
    public function me(){
        return $this->response->item($this->user, new UserTransformer());
    }

    //更新用户
    public function update(UserRequest $request){
        $user = $this->user();

        $attributes = $request->only(['name', 'email', 'intro']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }
}

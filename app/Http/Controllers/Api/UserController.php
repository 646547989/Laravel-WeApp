<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        User::create([
            'phone' => $verifyData['phone'],
            'name'  => $request->name,
            'password'  => Hash::make($request->password)
        ]);

        //删除验证码缓存
        Cache::forget($request->validatekey);
        return $this->response->created();
    }
}

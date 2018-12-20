<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Cache;

class CaptchaController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder){
        $phone=$request->phone;
        //生成缓存key
        $key=uniqid('captcha_');
        //缓存过期时间
        $expiredAt=now()->addMinutes(10);
        $captcha=$captchaBuilder->build();
        //写入缓存
        Cache::put($key, ['phone'=>$phone, 'captcha_code'=>$captcha->getPhrase()], $expiredAt);
        //返回数据
        $result=[
            'captcha_key' => $key,
            'expired_at'  => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];
        return $this->response->array($result)->setStatusCode(201);
    }
}

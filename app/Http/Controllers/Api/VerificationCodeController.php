<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodeController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms){
        //判断用户提交的文本验证码是否正确
        $captchaData=Cache::get($request->captcha_key);
        if (!$captchaData){
            return $this->response->error('文本验证码已失效', 422);
        }

        if (! hash_equals($captchaData['captcha_code'], $request->captcha_code)){
            return $this->response->errorUnauthorized('验证码不正确');
        }

        $phone=$request->phone;
        if (!app()->environment('production')){
            $code='9999';
        }else{
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
            try{
                $easySms->send($phone, ['content'=>'尊敬的汇加客户，您的验证码为：【'.$code.'】，请及时输入。']);
            }catch (NoGatewayAvailableException $exception){
                $message = $exception->getException('yunpian')->getMessage();
                return $this->response->errorInternal($message ?? '短信发送异常');
            }
        }
        $key=$phone.'_'.uniqid();
        $expiredAt = now()->addMinutes(10);
        //验证码10分钟过期
        Cache::put($key, ['code'=>$code, 'phone'=>$phone], $expiredAt);
        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}

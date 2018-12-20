<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizeRequest;
use App\Http\Requests\Api\AuthorizeSocialRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthorizeController extends Controller
{
    //第三方登录
    public function socialStore($type, AuthorizeSocialRequest $request){
        if (!in_array($type, ['weixin'])) {
            return $this->response->errorBadRequest();
        }

        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {

                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');

            } else {
                $token = $request->access_token;

                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $e) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }

        switch ($type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                // 没有用户，默认创建一个用户
                if (!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }

        $token=Auth::guard('api')->fromUser($user);

        return $this->responsedWithToken($token)->setStatusCode(201);
    }
    //普通登录
    public function store(AuthorizeRequest $request){
        $username=$request->username;
        //验证用户输入的是否是邮箱，否则输入的是手机号
        if (filter_var($username, FILTER_VALIDATE_EMAIL)){
            $data['email']=$username;
        }else{
            $data['phone']=$username;
        }
        $data['password']=$request->password;

        //验证用户输入的信息是否能匹配数据库
        if (!$token=Auth::guard('api')->attempt($data)){
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        //登录成功返回令牌、过期时间等
        return $this->responsedWithToken($token)->setStatusCode(201);
    }

    //封装返回令牌
    protected function responsedWithToken($token){
        //登录成功返回令牌、过期时间等
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    //刷新token
    public function update(){
        $token = Auth::guard('api')->refresh();
        return $this->responsedWithToken($token);
    }
    //删除token
    public function destroy(){
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }


}

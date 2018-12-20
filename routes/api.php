<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'    => ['cors', 'api.throttle'],
    //访问次数频率
    'limit' => config('api.rate_limits.sign.limit'),
    //失效周期
    'expires' => config('api.rate_limits.sign.expires'),
], function($api) {
    // 短信验证码
    $api->post('verificationCodes', 'VerificationCodeController@store')
        ->name('api.verificationCodes.store');
    // 用户注册
    $api->post('users', 'UserController@store')
        ->name('api.users.store');
    // 图片验证码
    $api->post('captchas', 'CaptchaController@store')
        ->name('api.captchas.store');
    // 第三方登录
    $api->post('socials/{social_type}/authorizes', 'AuthorizeController@socialStore')
        ->name('api.socials.authorizes.store');
    // 登录
    $api->post('authorizes', 'AuthorizeController@store')
        ->name('api.authorizes.store');
});
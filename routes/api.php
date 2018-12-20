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
    'middleware'    => ['cors', 'api.throttle', 'serializer:array', 'bindings'],
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
    // 刷新token
    $api->put('authorizes/current', 'AuthorizeController@update')
        ->name('api.authorizes.update');
// 删除token
    $api->delete('authorizes/current', 'AuthorizeController@destroy')
        ->name('api.authorizes.destroy');
    // 分类列表
    $api->get('categories', 'CategoryController@index')
        ->name('api.categories.index');
    //话题列表
    $api->get('topics', 'TopicController@index')
        ->name('api.topics.index');
    //指定用户发表的话题
    $api->get('users/{user}/topics', 'TopicController@userIndex')
        ->name('api.users.topics.index');
    //话题详情
    $api->get('topics/{topic}', 'TopicController@show')
        ->name('api.topics.show');

    // 需要 token 验证的接口
    $api->group(['middleware' => 'api.auth'], function($api) {
        // 当前登录用户信息
        $api->get('user', 'UserController@me')
            ->name('api.user.show');
        // 图片资源
        $api->post('images', 'ImageController@store')
            ->name('api.images.store');
        // 编辑登录用户信息
        $api->patch('user', 'UserController@update')
            ->name('api.user.update');
        // 发布话题
        $api->post('topics', 'TopicController@store')
            ->name('api.topics.store');
        //修改话题
        $api->patch('topics/{topic}', 'TopicController@update')
            ->name('api.topics.update');
        //删除话题
        $api->delete('topics/{topic}', 'TopicController@destroy')
            ->name('api.topics.destroy');
    });
});
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Index\IndexController@index')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//话题
Route::resource('topics', 'Index\TopicController');
Route::post('topics/uploadimg', 'Index\TopicController@uploadImg')->name('topics.upload');

//用户
Route::resource('users', 'Index\UserController', ['only'=>['edit', 'update', 'show']]);

//分类
Route::get('categories/{category}', 'Index\CategoryController@show')->name('categories.show');

//回复
Route::post('replies', 'Index\ReplyController@store')->name('replies.store');
Route::delete('replies/{reply}', 'Index\ReplyController@destroy')->name('replies.destroy');

Route::get('test', function (\Carbon\Carbon $carbon){
    $prevWeek=$carbon->previous()->toDateTimeString();
    $data=DB::select('select uid, name,avatar, count(uid) from (SELECT u.id as uid, u.avatar, u.name, r.content, r.created_at from users u INNER JOIN replies r ON u.id=r.user_id where r.created_at > ?) as userReply GROUP BY uid', [$prevWeek]);
    var_dump($data);
});


<?php
//路由转化为css类名,例如：users.show转为users-show
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

//截取字符串
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return mb_substr($excerpt, 0, $length);
}

//高亮导航;$link:当前导航链接
function active_menu($link, $class='active'){
    return substr_count(url()->full(), $link) ? $class : false;
}
<?php
//路由转化为css类名,例如：users.show转为users-show
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
@extends('index.layouts.app')
@section('body')
<div class="layui-container fly-marginTop fly-user-main">
    <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
        <li class="layui-nav-item">
            <a href="home.html">
                <i class="layui-icon">&#xe609;</i>
                我的主页
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="index.html">
                <i class="layui-icon">&#xe612;</i>
                用户中心
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="set.html">
                <i class="layui-icon">&#xe620;</i>
                基本设置
            </a>
        </li>
        <li class="layui-nav-item layui-this">
            <a href="message.html">
                <i class="layui-icon">&#xe611;</i>
                我的消息
            </a>
        </li>
    </ul>

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>


    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
            <button class="layui-btn layui-btn-danger" id="LAY_delallmsg">清空全部消息</button>
            <div  id="LAY_minemsg" style="margin-top: 10px;">
                <!--<div class="fly-none">您暂时没有最新消息</div>-->
                <ul class="mine-msg">
                    @foreach($notifications as $notification)
                    <li data-id="123">
                        <blockquote class="layui-elem-quote">
                            <a href="{{route('users.show', $notification->data['user_id'])}}" target="_blank"><cite>{{$notification->data['user_name']}}</cite></a>回答了您的求解<a target="_blank" href="{{$notification->data['topic_link']}}"><cite>{{$notification->data['topic_title']}}</cite></a>
                        </blockquote>
                        <p><span>{{$notification->created_at->diffForHumans()}}</span><a href="javascript:;" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
                    </li>
                    @endforeach
                </ul>
                {{$notifications->links('vendor.pagination.layui')}}
            </div>
        </div>
    </div>

</div>
@endsection
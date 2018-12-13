@extends('index.layouts.app')
@section('body')
<div class="fly-home fly-panel" style="background-image: url();">
    <img src="{{$user->avatar}}" alt="{{$user->name}}">
    <i class="iconfont icon-renzheng" title="Fly社区认证"></i>
    <h1>
        {{$user->name}}
        <!--
        <span style="color:#c00;">（管理员）</span>
        <span style="color:#5FB878;">（社区之光）</span>
        <span>（该号已被封）</span>
        -->
    </h1>


    <p class="fly-home-info margin-top">
        <i class="iconfont icon-shijian"></i><span>{{$user->created_at->diffForHumans()}} 加入</span>
    </p>

    <p class="fly-home-sign">（{{$user->intro}}）</p>

    <div class="fly-sns" data-user="">
        <a href="javascript:;" class="layui-btn layui-btn-primary fly-imActive" data-type="addFriend">加为好友</a>
        <a href="javascript:;" class="layui-btn layui-btn-normal fly-imActive" data-type="chat">发起会话</a>
    </div>

</div>

<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md6 fly-home-jie">
            <div class="fly-panel">
                <h3 class="fly-panel-title">{{$user->name}} 发表的话题</h3>
                <ul class="jie-row">
                    @include('index.user._topics',  ['topics' => $user->topics()->get()])
                    <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->
                </ul>
            </div>
        </div>

        <div class="layui-col-md6 fly-home-da">
            <div class="fly-panel">
                <h3 class="fly-panel-title">{{$user->name}} 最近的回复</h3>
                <ul class="home-jieda">
                    @include('index.user._replies',  ['replies' => $user->replies()->with('topic')->get()])
                    <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有回答任何问题</span></div> -->
                </ul>
            </div>
        </div>
    </div>
</div>
    @endsection
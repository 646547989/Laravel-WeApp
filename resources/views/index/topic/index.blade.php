@extends('index.layouts.app')
@section('title', '话题首页')
@section('body')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">

            <div class="fly-panel" style="margin-bottom: 0;">

                <div class="fly-panel-title fly-filter">
                    @foreach($categories as $category)
                        <a href="{{route('categories.show', $category->id)}}" class="{{active_menu(route('categories.show', $category->id), 'layui-this')}}">{{$category->name}}</a>
                        @if(! $loop->last)
                            <span class="fly-mid"></span>
                        @endif
                    @endforeach

                    <span class="fly-filter-right layui-hide-xs">
            <a href="{{url()->current()}}?order=default" class="{{!active_menu(url()->current().'?order=reply') ? 'layui-this' : ''}}">最新发表</a>
            <span class="fly-mid"></span>
            <a href="{{url()->current()}}?order=reply" class="{{active_menu(url()->current().'?order=reply', 'layui-this')}}">最新回复</a>
          </span>
                </div>

                <ul class="fly-list" id="topics-list">
                    @foreach($topics as $topic)
                        <li>
                            <a href="{{route('users.show', $topic->user_id)}}" class="fly-avatar">
                                <img src="{{$topic->user->avatar}}" alt="{{$topic->user->name}}">
                            </a>
                            <h2>
                                <a class="layui-badge">{{$topic->category->name}}</a>
                                <a href="{{route('topics.show', $topic->id)}}">{{$topic->title}}</a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="{{route('users.show', $topic->user_id)}}" link>
                                    <cite>{{$topic->user->name}}</cite>
                                </a>
                                <span>{{$topic->updated_at->diffForHumans()}}</span>

                                <span class="fly-list-nums">
                <i class="iconfont icon-pinglun1" title="回答"></i> {{$topic->reply_count}}
              </span>
                            </div>
                            <div class="fly-list-badge">
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div style="text-align: center">
                    <hr>
                    {{$topics->appends(Request::except('page'))->links('vendor.pagination.layui')}}

                </div>

            </div>
        </div>
        <div class="layui-col-md4">
        @include('index.layouts._index_sidebar')


        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use(['layer', 'element'], function () {
            var layer = layui.layer;
            var element = layui.element;

            @include('index.layouts._error')
            @include('index.layouts._message')
        });
    </script>
@endsection
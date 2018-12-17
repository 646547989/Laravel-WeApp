@extends('index.layouts.app')
@section('body')

    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8 content detail">
            <div class="fly-panel detail-box">
                <h1>{{$topic->title}}</h1>
                <div class="fly-detail-info">


                    <div class="fly-admin-box"></div>
                    <span class="fly-list-nums">
            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{$topic->reply_count}}</a>
          </span>
                </div>
                <div class="detail-about">
                    <a class="fly-avatar" href="{{route('users.show', $topic->user_id)}}">
                        <img src="{{$topic->user->avatar}}"
                             alt="{{$topic->user->name}}">
                    </a>
                    <div class="fly-detail-user">
                        <a href="{{route('users.show', $topic->user_id)}}" class="fly-link">
                            <cite>{{$topic->user->name}}</cite>
                            <i class="iconfont icon-renzheng" title="认证信息：dd"></i>
                        </a>
                        <span>{{$topic->created_at->diffForHumans()}}</span>
                    </div>

                    <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                        @can('handle', $topic)
                        <a href="{{route('topics.edit', $topic->id)}}" class="layui-btn layui-btn-xs jie-admin">编辑此贴</a>
                            <form action="{{route('topics.destroy', $topic->id)}}" method="post" style="display: inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="layui-btn layui-btn-xs jie-admin" type="submit">删除</button>
                            </form>

                            @else
                            &nbsp;{{$topic->user->intro}}
                        @endcan
                    </div>

                </div>
                <div class="detail-body photos">
                    {!! $topic->body !!}
                </div>
            </div>

            <div class="fly-panel detail-box" id="flyReply">
                <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                    <legend>回帖</legend>
                </fieldset>

                <ul class="jieda" id="jieda">
                @include('index.topic._replies', ['replies' => $topic->replies()->with('user', 'topic')->get()])


                    <!-- 无数据时 -->
                    <!-- <li class="fly-none">消灭零回复</li> -->
                </ul>

                <div class="layui-form layui-form-pane">
                    <form action="{{route('replies.store')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <div class="layui-form-item layui-form-text">
                            <a name="comment"></a>
                            <div class="layui-input-block">
                                <textarea id="L_content" name="content" required lay-verify="required"
                                          placeholder="请输入内容" class="layui-textarea fly-editor"
                                          style="height: 150px;"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <input type="hidden" name="jid" value="123">
                            <button class="layui-btn" type="submit">提交回复</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            @include('index.layouts._view_sidebar', ['user'=> $topic->user])

        </div>
    </div>
@endsection
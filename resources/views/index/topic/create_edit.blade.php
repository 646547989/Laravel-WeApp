@extends('index.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
    @endsection
@section('body')
    <div class="fly-panel" pad20 style="padding-top: 5px;">
        <!--<div class="fly-none">没有权限</div>-->
        <div class="layui-form layui-form-pane">
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title">
                    <li class="layui-this">{{isset($topic->id) ? '编辑帖子' : '发表新帖'}}<!-- 编辑帖子 --></li>
                </ul>
                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        @if(isset($topic->id))
                            <form action="{{route('topics.update', $topic->id)}}" method="post">
                                {{method_field('PUT')}}
                            @else
                                    <form action="{{route('topics.store')}}" method="post">
                            @endif

                            {{csrf_field()}}
                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md3">
                                    <label class="layui-form-label">所在专栏</label>
                                    <div class="layui-input-block">
                                        <select lay-verify="required" name="category_id" lay-filter="column">
                                            <option></option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(isset($topic->id) && $topic->category_id==$category->id)selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-col-md9">
                                    <label for="L_title" class="layui-form-label">标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="L_title" name="title" required lay-verify="required" value="{{isset($topic->id) ? $topic->title : old('title')}}" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item layui-form-text">
                                <div class="layui-input-block">
                                    <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required>{{isset($topic->id) ? $topic->body : old('body')}}</textarea>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="captcha" required lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div>
                                    <span style="color: #c00;"><img class="thumbnail captcha" src="{{ captcha_src('nomal') }}" onclick="this.src='/captcha/nomal?'+Math.random()" title="点击图片重新获取验证码"></span>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" type="submit">立即发布</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        layui.use(['layer', 'element', 'form'], function () {
            var layer = layui.layer;
            var element = layui.element;
            var form    = layui.form;
            @include('index.layouts._error')
            @include('index.layouts._message')
        });
    </script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{route('topics.upload')}}',
                    params: { _token: '{{ csrf_token() }}' },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>
@endsection
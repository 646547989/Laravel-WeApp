@extends('index.layouts.app')
@section('body')
    <div class="layui-container fly-marginTop fly-user-main">
        <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
            <li class="layui-nav-item">
                <a href="{{route('users.show', $user->id)}}">
                    <i class="layui-icon">&#xe609;</i>
                    我的主页
                </a>
            </li>
            <li class="layui-nav-item layui-this">
                <a href="{{route('users.edit', Auth::id())}}">
                    <i class="layui-icon">&#xe620;</i>
                    基本设置
                </a>
            </li>
            <li class="layui-nav-item">
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
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title" id="LAY_mine">
                    <li class="layui-this" lay-id="info">我的资料</li>
                    <li lay-id="avatar">头像</li>
                    <li lay-id="pass">密码</li>
                </ul>
                <div class="layui-tab-content" style="padding: 20px 0;">
                    <div class="layui-form layui-form-pane layui-tab-item layui-show">
                        <form method="post" action="{{route('users.update', $user->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="layui-form-item">
                                <label for="name" class="layui-form-label">姓名</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="name" name="name" required value="{{$user->name}}" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" required lay-verify="email"
                                           autocomplete="off" value="{{$user->email}}" class="layui-input" disabled="disabled">
                                </div>
                            </div>

                            <div class="layui-form-item layui-form-text">
                                <label for="L_sign" class="layui-form-label">签名</label>
                                <div class="layui-input-block">
                                    <textarea placeholder="随便写些什么刷下存在感" id="L_sign" name="intro" autocomplete="off"
                                              class="layui-textarea" style="height: 80px;">{{$user->intro}}</textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" key="set-mine" lay-filter="*" lay-submit>确认修改</button>
                            </div>
                        </form>
                    </div>

                    <div class="layui-form layui-form-pane layui-tab-item">
                        <div class="layui-form-item">
                            <div class="avatar-add">
                                <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过50KB</p>
                                <button type="button" class="layui-btn upload-img" id="avatar">
                                    <i class="layui-icon">&#xe67c;</i>上传头像
                                </button>
                                <img src="{{$user->avatar}}" id="avatar-img">
                                <span class="loading"></span>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form layui-form-pane layui-tab-item">
                        <form method="post" action="{{route('users.update', $user->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="layui-form-item">
                                <label for="L_pass" class="layui-form-label">新密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_pass" name="password" required lay-verify="required"
                                           autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_repass" class="layui-form-label">确认密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_repass" name="password_confirmation" required lay-verify="required"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" key="set-mine" lay-filter="*" lay-submit>确认修改</button>
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
        layui.use(['layer', 'element', 'upload', 'jquery'], function () {
            var layer = layui.layer;
            var element = layui.element;
            var upload  = layui.upload;
            var $       = layui.jquery;
            //执行上传
            var uploadInst = upload.render({
                elem: '#avatar', //绑定元素
                //method: 'put',
                url: '{{route('users.update', $user->id)}}', //上传接口
                data: {_token:'{{csrf_token()}}',_method: 'PUT'},
                field: 'avatar',
                done: function(res){
                    if (res.code){
                        layer.msg(res.msg, {icon: 6});
                        $('#avatar-img').attr('src', res.path);
                    }else{
                        layer.msg(res.msg, {icon: 5});
                    }
                },
                error: function(){
                    //请求异常回调
                }
            });
            @include('index.layouts._error')
            @include('index.layouts._message')
        });
    </script>
@endsection
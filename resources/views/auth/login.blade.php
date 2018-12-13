@extends('index.layouts.app')
@section('body')
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title">
                <li class="layui-this">登入</li>
                <li><a href="reg.html">注册</a></li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form layui-form-pane">
                        <form method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">邮箱</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" required lay-verify="required"
                                           value="{{ old('email') }}" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_pass" class="layui-form-label">密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_pass" name="password" required lay-verify="required"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验证码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="captcha" required lay-verify="required"
                                           placeholder="请输入正确的验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div>
                                    <span style="color: #c00;"><img class="thumbnail captcha"
                                                                    src="{{ captcha_src('nomal') }}"
                                                                    onclick="this.src='/captcha/nomal?'+Math.random()"
                                                                    title="点击图片重新获取验证码">
</span>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-inline">
                                    <input type="checkbox" name="remember" title="记住密码" lay-skin="primary">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" lay-filter="*" lay-submit>立即登录</button>
                                <span style="padding-left:20px;">
                  <a href="forget.html">忘记密码？</a>
                </span>
                            </div>
                            <div class="layui-form-item fly-form-app">
                                <span>或者使用社交账号登入</span>
                                <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})"
                                   class="iconfont icon-qq" title="QQ登入"></a>
                                <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})"
                                   class="iconfont icon-weibo" title="微博登入"></a>
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
        layui.use(['layer', 'element'], function () {
            var layer = layui.layer;
            var element = layui.element;
            @if ($errors->has('email'))
            layer.msg('{{ $errors->first('email') }}', {icon: 5});
            @endif
            @if ($errors->has('password'))
            layer.msg('{{ $errors->first('password') }}', {icon: 5});
            @endif
            @if ($errors->has('captcha'))
            layer.msg('{{ $errors->first('captcha') }}', {icon: 5});
            @endif
        });
    </script>
@endsection
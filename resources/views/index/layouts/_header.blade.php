<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="{{asset('/images/logo.png')}}" alt="layui">
        </a>
        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item layui-this">
                <a href="{{route('topics.index')}}"><i class="iconfont icon-jiaoliu"></i>话题</a>
            </li>
            <li class="layui-nav-item">
                <a href="case/case.html"><i class="iconfont icon-iconmingxinganli"></i>案例</a>
            </li>
            <li class="layui-nav-item">
                <a href="http://www.layui.com/" target="_blank"><i class="iconfont icon-ui"></i>框架</a>
            </li>
        </ul>

        <ul class="layui-nav fly-nav-user">
        @guest
            <!-- 未登入的状态 -->
            <li class="layui-nav-item">
                <a class="iconfont icon-touxiang layui-hide-xs" href="user/login.html"></a>
            </li>
            <li class="layui-nav-item">
                <a href="{{route('login')}}">登入</a>
            </li>
            <li class="layui-nav-item">
                <a href="{{route('register')}}">注册</a>
            </li>
            <li class="layui-nav-item layui-hide">
                <a href="/app/qq/" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" title="QQ登入" class="iconfont icon-qq"></a>
            </li>
            <li class="layui-nav-item layui-hide">
                <a href="/app/weibo/" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" title="微博登入" class="iconfont icon-weibo"></a>
            </li>
@else
            <!-- 登入后的状态 -->
                <li class="layui-nav-item">
                    <a href="{{route('topics.create')}}" title="添加话题"><i class="layui-icon">&#xe654;</i>  </a>
                </li>
                <li class="layui-nav-item">
                    <a href="{{route('notifications.index')}}">消息@if(Auth::user()->notification_count > 0)<span class="layui-badge-dot"></span>@endif</a>
                </li>
            <li class="layui-nav-item">
              <a class="fly-nav-avatar" href="javascript:;">
                <cite class="layui-hide-xs">{{Auth::user()->name}}</cite>
                <img src="{{Auth::user()->avatar}}">
              </a>
              <dl class="layui-nav-child">
                <dd><a href="{{route('users.edit', Auth::id())}}"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                <dd><a href="{{route('users.show', Auth::id())}}"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
                <hr style="margin: 5px 0;">
                <dd><a href="{{route('logout')}}" style="text-align: center;">退出</a></dd>
              </dl>
            </li>
            @endguest
        </ul>
    </div>
</div>
<div class="fly-panel">
    <h3 class="fly-panel-title">温馨通道</h3>
    <div class="fly-panel-main">
        <a href="{{route('topics.create')}}" target="_blank" class="fly-zanzhu"
           style="background-color: #5FB878;"><i class="layui-icon">&#xe642;</i> 快速发帖</a>
    </div>
</div>

<div class="fly-panel">
    <div class="fly-panel-title">
        作者详情
    </div>
    <div class="fly-panel-main">
        <div class="detail-about detail-about-reply">
            <a class="fly-avatar" href="http://weapp.im/users/7">
                <img src="/avatar/aratar_678.jpg"
                     alt=" ">
            </a>
            <div class="fly-detail-user">
                <a href="http://weapp.im/users/7" class="fly-link">
                    <cite>紅俊冠</cite>
                    <i class="iconfont icon-renzheng" title="认证信息：紅俊冠"></i>
                </a>
            </div>

            <div class="detail-hits">
                <span>{{Auth::user()->intro}}</span>
            </div>


        </div>
        <hr>
        <div class="layui-row layui-col-space10" style="text-align: center">
            <div class="layui-col-md4">
                <div style="font-size: 14px; color: #8590a6;">话题</div>
                <strong class="NumberBoard-itemValue" title="203">203</strong>
            </div>
            <div class="layui-col-md4">
                <div style="font-size: 14px; color: #8590a6;">回答</div>
            </div>
            <div class="layui-col-md4">
                <span>加入<br>{{Auth::user()->created_at->diffForHumans()}}</span>
            </div>
        </div>


        <div style="text-align: center">
            <img src="{{Auth::user()->avatar}}" alt="" style="padding: 2px; border: solid #ccc 1px; border-radius: 5px">
        </div>
        <div style="padding: 30px;">
            <hr>
            <h4><strong>个人简介</strong></h4>
            <p>{{Auth::user()->intro}}</p>
            <hr>
            <h4><strong>注册于</strong></h4>
            <p>1周前</p>
            <hr>
            <h4><strong>最后活跃</strong></h4>
            <p title="2018-12-13 09:50:10">{{Auth::user()->created_at->diffForHumans()}}</p>
        </div>
        <hr>
        <div>{{Auth::user()->name}}</div>
        <div>{{Auth::user()->intro}}</div>
        <div>{{Auth::user()->created_at->diffForHumans()}}</div>


    </div>
</div>

@include('index.layouts._reply_rank')
@include('index.layouts._topic_hot')


<div class="fly-panel">
    <div class="fly-panel-title">
        友情赞助
    </div>
    <div class="fly-panel-main">
        <a href="http://www.diandian100.cn" target="_blank" class="fly-zanzhu"
           style="background-color: #20222A; background-image: linear-gradient(to right,#20222A,#3E4251);">点点技术博客</a> <a
                href="http://yun.diandian100.cn" target="_blank" class="fly-zanzhu"
                style="background-color: #009688; background-image: linear-gradient(to right,#009688,#5FB878);">点点云主机</a>
    </div>
</div>

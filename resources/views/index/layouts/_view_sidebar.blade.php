@include('index.layouts._about_author', ['user'=>$user])
<div class="fly-panel">
    <h3 class="fly-panel-title">温馨通道</h3>
    <div class="fly-panel-main">
        <a href="{{route('topics.create')}}" target="_blank" class="fly-zanzhu"
           style="background-color: #5FB878;"><i class="layui-icon">&#xe642;</i> 快速发帖</a>
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

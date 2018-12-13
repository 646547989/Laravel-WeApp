<dl class="fly-panel fly-list-one">
    <dt class="fly-panel-title">本周热议</dt>
    @foreach($topics as $topic)
    <dd>
        <a href="jie/detail.html">{{$topic->title}}</a>
        <span><i class="iconfont icon-pinglun1"></i> {{$topic->reply_count}}</span>
    </dd>
    @endforeach
        <!-- 无数据时 -->
    <!--
    <div class="fly-none">没有相关数据</div>
    -->
</dl>
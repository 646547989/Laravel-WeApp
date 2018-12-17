<div class="fly-panel">
    <div class="fly-panel-title">
        关于作者
    </div>
    <div class="fly-panel-main about-author">
        <div class="detail-about detail-about-reply">
            <a class="fly-avatar" href="{{route('users.show', $user->id)}}">
                <img src="{{$user->avatar}}">
            </a>
            <div class="fly-detail-user">
                <a href="{{route('users.show', $user->id)}}" class="fly-link">
                    <cite>{{$user->name}}</cite>
                    <i class="iconfont icon-renzheng" title="认证信息：{{$user->name}}"></i>
                </a>
            </div>

            <div class="detail-hits">
                <span>{{$user->intro}}</span>
            </div>


        </div>
        <hr class="margin-top-lg">
        <div class="layui-row layui-col-space10 author-mark">
            <div class="layui-col-md4">
                <a href="" class="item-title">话题</a>
                <strong class="item-desc">{{$user->topics->count()}}</strong>
            </div>
            <div class="layui-col-md4">
                <a href="" class="item-title">回答</a>
                <strong class="item-desc">{{$user->replies->count()}}</strong>
            </div>
            <div class="layui-col-md4">
                <a href="" class="item-title">加入</a>
                <strong class="item-desc">{{$user->created_at->diffForHumans()}}</strong>
            </div>
        </div>


    </div>
</div>
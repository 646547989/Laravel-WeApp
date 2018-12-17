@foreach($replies as $reply)
<li class="jieda-daan">
    <a name="reply{{ $reply->id }}"></a>
    <div class="detail-about detail-about-reply">
        <a class="fly-avatar" href="{{route('users.show', $reply->user->id)}}">
            <img src="{{$reply->user->avatar}}"
                 alt=" ">
        </a>
        <div class="fly-detail-user">
            <a href="{{route('users.show', $reply->user->id)}}" class="fly-link">
                <cite>{{$reply->user->name}}</cite>
                <i class="iconfont icon-renzheng" title="认证信息：{{$reply->user->name}}"></i>
            </a>
        </div>

        <div class="detail-hits">
            <span>{{$reply->created_at->diffForHumans()}}</span>
        </div>


    </div>
    <div class="detail-body jieda-body photos">
        <p>{{$reply->content}}</p>
    </div>
    @can('handle', $reply)
    <div class="jieda-reply">
        <form action="{{route('replies.destroy', $reply->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="layui-btn layui-btn-xs layui-btn-danger" type="submit"><i class="layui-icon">&#xe640;</i>删除</button>
        </form>



    </div>
        @endcan
</li>
@endforeach
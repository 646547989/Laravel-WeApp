@foreach($topics as $topic)
<li>
    <a href="{{route('topics.show', $topic->id)}}" class="jie-title"> {{$topic->title}}</a>
    <i>{{$topic->created_at->diffForHumans()}}</i>
    <em class="layui-hide-xs"><i class="iconfont icon-pinglun1" title="回答"></i> {{$topic->reply_count}}</em>
</li>
    @endforeach
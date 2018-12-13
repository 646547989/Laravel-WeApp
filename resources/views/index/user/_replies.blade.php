@foreach($replies as $reply)
<li>
    <p>
        <span>{{$reply->created_at->diffForHumans()}}</span>
        在<a href="{{route('topics.show', $reply->topic_id)}}" target="_blank">{{$reply->topic->title}}</a>中回答：
    </p>
    <div class="home-dacontent">
        {{$reply->content}}
    </div>
</li>
    @endforeach
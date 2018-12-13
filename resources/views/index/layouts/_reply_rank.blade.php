<div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
    <h3 class="fly-panel-title">回贴周榜</h3>
    <dl>
        @foreach($activeUsers as $activeUser)
        <dd>
            <a href="{{route('users.show', $activeUser->uid)}}">
                <img src="{{$activeUser->avatar}}"><cite>{{$activeUser->name}}</cite><i>{{$activeUser->reply_count}}次回答</i>
            </a>
        </dd>
        @endforeach
    </dl>
</div>
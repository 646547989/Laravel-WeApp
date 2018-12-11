<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 2018/12/11
 * Time: 15:46
 */

namespace App\Observers;


use App\Models\Reply;
use Illuminate\Support\Facades\DB;

class ReplyObserver
{
    //发表回复前过滤恶意代码
    public function creating(Reply $reply){
        $reply->content=clean($reply->content, 'content');
    }

    //评论成功，话题回复数自动加1
    public function created(Reply $reply){
        DB::table('topics')->where('id', $reply->topic_id)->increment('reply_count');
    }

    //删除评论，话题回复数自动减1
    public function deleted(Reply $reply){
        DB::table('topics')->where('id', $reply->topic_id)->decrement('reply_count');
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 2018/12/11
 * Time: 13:47
 */

namespace App\Observers;


use App\Models\Topic;
use Illuminate\Support\Facades\DB;

class TopicObserver
{
    //监听模型，保存话题自动过滤恶意代码，且填充简介
    public function saving(Topic $topic){
        $topic->body=clean($topic->body, 'content');
        $topic->except=make_excerpt($topic->body);
    }

    //删除话题自动删除话题对应的回复
    public function deleted(Topic $topic){
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
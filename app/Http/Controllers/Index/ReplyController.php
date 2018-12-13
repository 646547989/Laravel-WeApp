<?php

namespace App\Http\Controllers\Index;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function store(Request $request, Reply $reply){
        $this->validate($request, ['content'=>'required|min:3|max:200']);
        $reply->content=$request->content;
        $reply->user_id=\Auth::id();
        $reply->topic_id=$request->topic_id;
        $reply->save();
        return back()->with('success', '回复成功');
    }

    public function destroy(Reply $reply){
        $reply->delete();
        return back()->with('success', '回复成功删除');
    }
}

<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\TopicRequest;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\TopicTransformer;
use Dingo\Api\Http\Request;

class TopicController extends Controller
{
    public function store(TopicRequest $request, Topic $topic){
        $topic->fill($request->all());
        $topic->user_id = $this->user()->id;
        $topic->save();

        return $this->response->item($topic, new TopicTransformer())
            ->setStatusCode(201);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('handle', $topic);

        $topic->update($request->all());
        return $this->response->item($topic, new TopicTransformer());
    }

    public function destroy(Topic $topic){
        $this->authorize('handle', $topic);
        $topic->delete();
        return $this->response->noContent();
    }
    //话题列表
    public function index(Request $request){
        if ($categoryId=$request->category_id){
            $topics=Topic::where('category_id', $categoryId)->withOrder($request->order)->paginate(20);
        }else{
            $topics=Topic::withOrder($request->order)->paginate(3);
        }
        return $this->response->paginator($topics, new TopicTransformer())->setStatusCode(201);
    }

    //用户发表的话题
    public function userIndex(User $user){
        $topics=$user->topics()->paginate(5);
        return $this->response->paginator($topics, new TopicTransformer())->setStatusCode(201);
    }

    //话题详情
    public function show(Topic $topic){
        return $this->response->item($topic, new TopicTransformer());
    }
}

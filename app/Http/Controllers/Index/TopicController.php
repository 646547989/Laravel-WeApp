<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->paginate(10);
        $categories = Category::all();
        return view('index.topic.index', compact('topics', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('index.topic.create_edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id=\Auth::id();
        $topic->save();
        return redirect()->route('topics.show', $topic->id)->with('success', '话题添加成功');
    }

    public function uploadImg(TopicRequest $request){
        if ($request->has('upload_file')){
            // 初始化返回数据，默认是失败的
            $data = [
                'success'   => false,
                'msg'       => '上传失败!',
                'file_path' => ''
            ];
            //存储相对目录
            $folder_name = '/uploads/topics/'. date("Y/m/d", time());
            //上传绝对目录
            $upload_path = public_path() . $folder_name;
            $extension = strtolower($request->upload_file->getClientOriginalExtension()) ?: 'png';
            $filename = \Auth::id() . '_' . uniqid() . '_' . str_random(5) . '.' . $extension;
            $result=$request->upload_file->move($upload_path, $filename);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $folder_name.'/'.$filename;
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('index.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $categories=Category::all();
        return view('index.topic.create_edit', compact('categories', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->all());
        return redirect()->route('topics.show', $topic->id)->with('success', '话题更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('success', '话题删除成功');
    }
}

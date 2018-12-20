<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ImageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImageController extends Controller
{
    public function store(ImageRequest $request, Image $image){
        $user=$this->user();
        //文件保存路径
        $forder ='/uploads/'.$request->type.'/'.date('Y/m/d', time());
        //上传路径
        $upload=public_path().$forder;
        //文件扩展
        $extension = strtolower($request->image->getClientOriginalExtension()) ?: 'png';
        //文件名称
        $filename = $user->id . '_' . uniqid() . '.' . $extension;
        //保存图片
        $request->image->move($upload, $filename);
        $image->path=$forder.'/'.$filename;
        $image->type=$request->type;
        $image->user_id=$user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer())->setStatusCode(201);
    }
}

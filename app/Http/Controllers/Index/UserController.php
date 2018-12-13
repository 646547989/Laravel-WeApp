<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show(User $user){
        return view('index.user.show', compact('user'));
    }
    public function edit(User $user){
        return view('index.user.edit', compact('user'));
    }
    public function update(UserRequest $request, User $user){
        $data=$request->all();
        if ($request->hasFile('avatar')) {
            $validate = Validator::make($request->all(), [
                'avatar' => 'max:500'
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'code'  => 0,
                    'msg'   => $validate->errors()->first()
                ]);
            }else{
                //存储相对目录
                $folder_name = '/uploads/avatar/'. date("Y/m/d", time());
                $upload_path = public_path() . $folder_name;
                $extension = strtolower($request->avatar->getClientOriginalExtension()) ?: 'png';
                $filename = $user->id . '_' . uniqid() . '_' . str_random(5) . '.' . $extension;
                $request->avatar->move($upload_path, $filename);
                $user->update(['avatar'=>$folder_name.'/'.$filename]);
                return response()->json([
                    'code'  => 1,
                    'msg'   => '上传成功',
                    'path'  => $folder_name.'/'.$filename
                ]);
            }
        }else{
            if ($request->has('password')){
                if (empty($request->password)){
                    unset($data['password']);
                }else{
                    $data['password'] = Hash::make($data['password']);
                }
            }
            $user->update($data);
            return back()->with('success', '用户修改成功');
        }

    }
    public function upload(){}
}

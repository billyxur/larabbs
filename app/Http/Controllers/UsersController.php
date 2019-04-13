<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //显示用户个人信息
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader ,User $user)
    {
        $data = $request->all();
//        if($user->update($data)){
//            return redirect()->route('users.show', $user->id)->with('success', '个人信息更新成功');
//        }
//
//        return redirect()->route('users.show', $user->id)->with('danger', '个人信息更新失败');

        if($request->avatar){
            $res = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if($res){
                $data['avatar'] = $res['path'];
            }
        }

        /**使用了表单验证，所有表单提交数据都经过UserRequest验证，如果更新失败会直接抛出exception,并重定向至上一个页面，附带验证失败的信息。**/
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人信息更新成功');
    }
}

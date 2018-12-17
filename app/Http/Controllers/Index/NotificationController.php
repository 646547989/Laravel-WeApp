<?php

namespace App\Http\Controllers\Index;


class NotificationController extends Controller
{
    public function index(){
        $notifications=\Auth::user()->notifications()->paginate(5);
        // 标记为已读，未读数量清零
        \Auth::user()->markAsRead();
        return view('index.user.notification', compact('notifications'));
    }
}

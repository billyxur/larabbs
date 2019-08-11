<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public  function  __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 获取用户的所有通知信息
        $notifications = Auth::user()->notifications()->paginate(20);

        //标记为已读， 未读数量清0
        Auth::user()->markAsRead();
        return view('notifications.index', compact('notifications'));
    }
}

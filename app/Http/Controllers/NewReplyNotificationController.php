<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewReplyNotificationController extends Controller
{
    public function index()
    {
        return [
            'read' => NotificationResource::collection(Auth::user()->readNotifications),
            'unread' => NotificationResource::collection(Auth::user()->unreadNotifications),
        ];
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}

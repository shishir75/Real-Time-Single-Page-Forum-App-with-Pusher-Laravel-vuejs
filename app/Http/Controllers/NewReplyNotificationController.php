<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewReplyNotificationController extends Controller
{
    public function index()
    {
        return [
            'read' => Auth::user()->readNotifications,
            'unread' => Auth::user()->unreadNotifications,
        ];
    }
}

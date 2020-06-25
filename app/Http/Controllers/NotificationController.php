<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FormatTime;
use App\Notification;

class NotificationController extends Controller
{
    public function updateTime(Request $request)
    {
        $notification = Notification::find($request->id);

        return response()->json(['time' => FormatTime::LongTimeFilter($notification->created_at)], 200);
    }
}

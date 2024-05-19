<?php

namespace App\Http\Controllers\V1\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function show(Notification $notification)
    {
        return $notification;
    }

    public function store(Request $request)
    {
        return Notification::create($request->all());
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->update($request->all());
        return $notification;
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }
}

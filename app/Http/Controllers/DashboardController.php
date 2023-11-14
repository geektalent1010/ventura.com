<?php

namespace App\Http\Controllers;

use App\Post;
use App\Channel;
use App\Requests;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authUser = Auth::user();
        $otherUser = $channelInfo = null;
        $isNewRequests = false;
        $isNews = false;
        $channels = Channel::where('user_id', '=', $authUser->id)->where('is_connected', '=', 1)->get();
        $lastNews = Post::where('type', '=', 4)->where('is_active', '=', 1)->where('created_by', '!=', $authUser->id)->orderBy('created_at', 'desc')->first();
        $lastRequest = Requests::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->first();
        if (isset($authUser->notification)) {
            if (isset($lastNews) && $lastNews->id != $authUser->notification->last_read_news_id) {
                $isNews = true;
            }
            if (isset($lastRequest) && $lastRequest->id != $authUser->notification->last_read_request_id) {
                $isNewRequests = true;
            }
        } else {
            Notification::create([
                'user_id' => $authUser->id,
            ]);
            if (isset($lastNews)) {
                $isNews = true;
            }
            if (isset($lastRequest)) {
                $isNewRequests = true;
            }
        }
        if ($authUser->IsAdmin()) {
            return view('admin.dashboard', compact('authUser', 'otherUser', 'channelInfo', 'channels', 'isNewRequests', 'isNews'));
        }
        return view('dashboard', compact('authUser', 'otherUser', 'channelInfo', 'channels', 'isNewRequests', 'isNews'));
    }
}

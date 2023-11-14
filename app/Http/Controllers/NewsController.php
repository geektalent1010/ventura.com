<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class NewsController extends Controller
{
    public function index()
    {
        $data['authUser'] = $authUser = Auth::user();
        $data['posts'] = Post::where('type', '=', 4)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();
        $lastNews = Post::where('type', '=', 4)->where('is_active', '=', 1)->where('created_by', '!=', $authUser->id)->orderBy('created_at', 'desc')->first();
        if (isset($authUser->notification)) {
            if (isset($lastNews) && $lastNews->id != $authUser->notification->last_read_news_id) {
                $notification = $authUser->notification;
                $notification->last_read_news_id = $lastNews->id;
                $notification->save();
            }
        } else {
            if (isset($lastNews)) {
                Notification::create([
                    'user_id' => $authUser->id,
                    'last_read_news_id' => $lastNews->id
                ]);
            }
        }
        return view('panel.news.mine', $data);
    }

    public function mine() 
    {
        $data['authUser'] = Auth::user();
        $data['posts'] = Post::where('type', '=', 4)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.news.mine', $data);
    }

    public function create()
    {
        $data['authUser'] = Auth::user();

        return view('panel.news.create', $data);
    }

    public function edit($id)
    {
        $data['authUser'] = Auth::user();
        $data['post'] = Post::find($id);
        if (!isset($data['post']) || $data['post']->created_by != Auth::user()->id) {
            return redirect()->route('news.mine');
        }

        return view('panel.news.edit', $data);
    }
}

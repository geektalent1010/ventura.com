<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;

class StoriesController extends Controller
{
    public function index()
    {
        $data['authUser'] = auth()->user();
        $data['stories'] = Post::where('type', '=', 1)->where('is_active', '=', 1)->orderBy('created_at',
            'desc')->get();

        return view('panel.stories.index', $data);
    }

    public function create()
    {
        $data['user'] = auth()->user();

        return view('panel.stories.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = auth()->user();
        $data['story'] = Post::find($id);
        if (! isset($data['story']) || $data['story']->created_by != auth()->user()->id) {
            return redirect()->route('stories.mine');
        }

        return view('panel.stories.edit', $data);
    }

    public function friendsStory()
    {
        $data['authUser'] = auth()->user();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['stories'] = Post::where('type', '=', 1)->whereIn('created_by', $friendIds)->where('is_active', '=',
            1)->orderBy('created_at', 'desc')->get();

        return view('panel.stories.friends', $data);
    }

    public function myStory()
    {
        $data['authUser'] = auth()->user();
        $data['stories'] = Post::where('type', '=', 1)->where('is_active', '=', 1)->where('created_by',
            $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.stories.mine', $data);
    }
}

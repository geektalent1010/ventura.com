<?php

namespace App\Http\Controllers;

use App\User;
use App\Friend;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class StoriesController extends Controller
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

    public function index()
    {
        $data['authUser'] = Auth::user();
        $data['stories'] = Post::where('type', '=', 1)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.stories.index', $data);
    }

    public function friends_story()
    {
        $data['authUser'] =  Auth::user();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['stories'] = Post::where('type', '=', 1)->whereIn('created_by', $friendIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.stories.friends', $data);
    }

    public function my_story()
    {
        $data['authUser'] = Auth::user();
        $data['stories'] = Post::where('type', '=', 1)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.stories.mine', $data);
    }

    public function create()
    {
        $data['user'] = Auth::user();

        return view('panel.stories.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = Auth::user();
        $data['story'] = Post::find($id);
        if (!isset($data['story']) || $data['story']->created_by != Auth::user()->id) {
            return redirect()->route('stories.mine');
        }

        return view('panel.stories.edit', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;

class WisdomContoller extends Controller
{
    public function index()
    {
        $data['authUser'] = auth()->user();
        $data['stories'] = Post::where('type', '=', 5)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.wisdom.index', $data);
    }

    public function create()
    {
        $data['user'] = auth()->user();

        return view('panel.wisdom.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = auth()->user();
        $data['story'] = Post::find($id);
        if (! isset($data['story']) || $data['story']->created_by != auth()->user()->id) {
            return redirect()->route('wisdom.mine');
        }

        return view('panel.wisdom.edit', $data);
    }

    public function my_story()
    {
        $data['authUser'] = auth()->user();
        $data['stories'] = Post::where('type', '=', 5)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.wisdom.mine', $data);
    }
}

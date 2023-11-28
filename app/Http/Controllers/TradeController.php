<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;

class TradeController extends Controller
{
    public function index()
    {
        $data['authUser'] = auth()->user();
        $data['trades'] = Post::where('type', '=', 2)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.index', $data);
    }

    public function create()
    {
        $data['user'] = auth()->user();

        return view('panel.trade.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = auth()->user();
        $data['trade'] = Post::find($id);
        if (! isset($data['trade']) || $data['trade']->created_by != auth()->user()->id) {
            return redirect()->route('trades.mine');
        }

        return view('panel.trade.edit', $data);
    }

    public function friend()
    {
        $data['authUser'] = auth()->user();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['trades'] = Post::where('type', '=', 2)->whereIn('created_by', $friendIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.friends', $data);
    }

    public function mine()
    {
        $data['authUser'] = auth()->user();
        $data['trades'] = Post::where('type', '=', 2)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.mine', $data);
    }
}

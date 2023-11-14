<?php

namespace App\Http\Controllers;

use App\User;
use App\Friend;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class TradeController extends Controller
{
    public function index()
    {
        $data['authUser'] = Auth::user();
        $data['trades'] = Post::where('type', '=', 2)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.index', $data);
    }

    public function friend()
    {
        $data['authUser'] = Auth::user();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['trades'] = Post::where('type', '=', 2)->whereIn('created_by', $friendIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.friends', $data);
    }

    public function mine()
    {
        $data['authUser'] = Auth::user();
        $data['trades'] = Post::where('type', '=', 2)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.trade.mine', $data);
    }

    public function create()
    {
        $data['user'] = Auth::user();

        return view('panel.trade.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = Auth::user();
        $data['trade'] = Post::find($id);
        if (!isset($data['trade']) || $data['trade']->created_by != Auth::user()->id) {
            return redirect()->route('trades.mine');
        }

        return view('panel.trade.edit', $data);
    }
}

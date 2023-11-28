<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use App\Models\User;

class EventsController extends Controller
{
    public function create()
    {
        $data['user'] = auth()->user();

        return view('panel.events.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = auth()->user();
        $data['post'] = Post::find($id);
        if (! isset($data['post']) || $data['post']->created_by != auth()->user()->id) {
            return redirect()->route('events.mine');
        }

        return view('panel.events.edit', $data);
    }

    public function company()
    {
        $data['authUser'] = auth()->user();
        // $companyIds = User::where('user_type', '=', 1)->pluck('id')->toArray();
        // $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $companyIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();
        $data['events'] = Post::where('type', '=', 3)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.company', $data);
    }

    public function coach()
    {
        $data['authUser'] = auth()->user();
        $coachIds = User::where('user_type', '=', 2)->pluck('id')->toArray();
        $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $coachIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.coach', $data);
    }

    public function distributor()
    {
        $data['authUser'] = auth()->user();
        // $distributorIds = User::where('user_type', '=', 0)->pluck('id')->toArray();
        // $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $distributorIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $friendIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.distributor', $data);
    }

    public function mine()
    {
        $data['authUser'] = auth()->user();
        $data['events'] = Post::where('type', '=', 3)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.events.mine', $data);
    }
}

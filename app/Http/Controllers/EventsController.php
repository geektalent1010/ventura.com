<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class EventsController extends Controller
{
    public function company() 
    {
        $data['authUser'] = Auth::user();
        // $companyIds = User::where('user_type', '=', 1)->pluck('id')->toArray();
        // $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $companyIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();
        $data['events'] = Post::where('type', '=', 3)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.company', $data);
    }

    public function coach() 
    {
        $data['authUser'] = Auth::user();
        $coachIds = User::where('user_type', '=', 2)->pluck('id')->toArray();
        $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $coachIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.coach', $data);
    }

    public function distributor() 
    {
        $data['authUser'] = Auth::user();
        // $distributorIds = User::where('user_type', '=', 0)->pluck('id')->toArray();
        // $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $distributorIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();
        $friendIds = Friend::where('user_id', '=', $data['authUser']->id)->pluck('connected_user_id')->toArray();
        $data['events'] = Post::where('type', '=', 3)->whereIn('created_by', $friendIds)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->get();

        return view('panel.events.distributor', $data);
    }

    public function mine() 
    {
        $data['authUser'] = Auth::user();
        $data['events'] = Post::where('type', '=', 3)->where('is_active', '=', 1)->where('created_by', $data['authUser']->id)->orderBy('created_at', 'desc')->get();

        return view('panel.events.mine', $data);
    }

    public function create()
    {
        $data['user'] = Auth::user();

        return view('panel.events.create', $data);
    }

    public function edit($id)
    {
        $data['user'] = Auth::user();
        $data['post'] = Post::find($id);
        if (!isset($data['post']) || $data['post']->created_by != Auth::user()->id) {
            return redirect()->route('events.mine');
        }

        return view('panel.events.edit', $data);
    }
}

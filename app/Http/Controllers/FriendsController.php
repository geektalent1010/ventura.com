<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        $requests = Requests::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->get();
        $lastRequest = Requests::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->orderBy('created_at', 'desc')->first();
        if (isset($authUser->notification)) {
            if (isset($lastRequest) && $lastRequest->id !== $authUser->notification->last_read_request_id) {
                $notification = $authUser->notification;
                $notification->last_read_request_id = $lastRequest->id;
                $notification->save();
            }
        } else {
            if (isset($lastRequest)) {
                Notification::create([
                    'user_id' => $authUser->id,
                    'last_read_request_id' => $lastRequest->id,
                ]);
            }
        }

        return view('panel.friends.index', compact('requests'));
    }

    public function individuals()
    {
        $authUser = auth()->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $friends = User::where('user_type', '=', 0)->whereIn('id', $friendIds)->get();

        return view('panel.friends.individuals', compact('friends'));
    }

    public function companies()
    {
        $authUser = auth()->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $friends = User::where('user_type', '=', 1)->whereIn('id', $friendIds)->get();

        return view('panel.friends.companies', compact('friends'));
    }

    public function coaches()
    {
        $authUser = auth()->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $friends = User::where('user_type', '=', 2)->whereIn('id', $friendIds)->get();

        return view('panel.friends.coaches', compact('friends'));
    }

    public function accept(Request $request)
    {
        $requestInfo = Requests::find($request->request_id);
        Friend::create([
            'user_id' => $requestInfo->user_id,
            'connected_user_id' => $requestInfo->requester,
        ]);
        Friend::create([
            'user_id' => $requestInfo->requester,
            'connected_user_id' => $requestInfo->user_id,
        ]);
        $sameRequest = Requests::where('user_id', $requestInfo->requester)->where('requester', $requestInfo->user_id)->first();
        if (isset($sameRequest)) {
            $sameRequest->delete();
        }
        $requestInfo->delete();

        return response()->json(['success' => 'The request successfully accepted.']);
    }

    public function remove(Request $request)
    {
        $friend = Friend::where('user_id', '=', $request->user()->id)->where('connected_user_id', '=', $request->friend_id);
        $friend->delete();
        $friend = Friend::where('connected_user_id', '=', $request->user()->id)->where('user_id', '=', $request->friend_id);
        $friend->delete();

        return response()->json(['success' => 'The friend successfully removed.']);
    }
}

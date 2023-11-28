<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Friend;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class ChatController extends Controller
{
    public function index()
    {
        return view('panel.chat.search');
    }

    public function filter(Request $request)
    {
        $authUser = $request->user();
        $activeUserIds = Channel::where('user_id', '=', $authUser->id)->where('is_connected', '=', 1)->pluck('receive_user_id')->toArray();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $data = Profile::query()
            ->when($keyword = $request->get('keyword'), function ($query) use ($keyword) {
                /** @var Builder $query */
                $query->where(function ($query) use ($keyword) {
                    /** @var Builder $query */
                    $query->whereRaw('concat(first_name," ",last_name) LIKE ?', "{$keyword}%");
                });
            })
            ->with('user')
            ->whereHas('user', function ($query) {
                $query->where('user_type', 0);
            })
            ->where('user_id', '<>', $authUser->id)
            ->whereNotIn('user_id', $activeUserIds)
            ->whereIn('user_id', $friendIds)
            ->get();

        return response()->json($data);
    }

    public function chatRoomCreate(Request $request)
    {
        $authUser = auth()->user();
        $otherUser = User::find($request->otherUserId);
        $channelInfo = Channel::whereIn('channel_unique_name', [$authUser->id.'_'.$otherUser->id, $otherUser->id.'_'.$authUser->id])->where('user_id', '=', $authUser->id)->first();

        if (isset($channelInfo)) {
            $channelInfo->is_connected = 1;
            $channelInfo->save();

            return response()->json(['status' => true, 'exist' => true, 'unique_name' => $channelInfo->channel_unique_name]);
        } else {
            $uniqueName = $authUser->id.'_'.$otherUser->id;
            Channel::create([
                'user_id' => $authUser->id,
                'receive_user_id' => $otherUser->id,
                'channel_unique_name' => $uniqueName,
                'is_connected' => 1,
                'last_message_readed_at' => new Carbon(),
            ]);

            Channel::create([
                'user_id' => $otherUser->id,
                'receive_user_id' => $authUser->id,
                'channel_unique_name' => $uniqueName,
                'is_connected' => 1,
                'last_message_readed_at' => new Carbon(),
            ]);

            $twilio = new Client(config('app.TWILIO_AUTH_SID'), config('app.TWILIO_AUTH_TOKEN'));

            // Fetch channel or create a new one if it doesn't exist
            try {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->fetch();
            } catch (\Twilio\Exceptions\RestException $e) {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels
                    ->create([
                        'uniqueName' => $uniqueName,
                        'type' => 'private',
                    ]);
            }

            // Add first user to the channel
            try {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->members($authUser->email)
                    ->fetch();

            } catch (\Twilio\Exceptions\RestException $e) {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->members
                    ->create($authUser->email);
            }

            // Add second user to the channel
            try {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->members($otherUser->email)
                    ->fetch();

            } catch (\Twilio\Exceptions\RestException $e) {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->members
                    ->create($otherUser->email);
            }

            return response()->json(['status' => true, 'exist' => false]);
        }

        return response()->json(['status' => false, 'message' => 'error']);
    }

    public function chatting(Request $request, $ids = null)
    {
        $authUser = $request->user();
        $otherUser = $channelInfo = null;
        $channels = Channel::where('user_id', '=', $authUser->id)->where('is_connected', '=', 1)->get();
        if (isset($ids) && explode('_', $ids)[1] != '') {
            $otherUser = User::find(explode('_', $ids)[1]);

            $channelInfo = Channel::whereIn('channel_unique_name', [$authUser->id.'_'.$otherUser->id, $otherUser->id.'_'.$authUser->id])->where('user_id', '=', $authUser->id)->first();
            if (! isset($channelInfo)) {
                $channelInfo = Channel::where('user_id', '=', $authUser->id)->orderby('last_message_readed_at', 'desc')->first();
            }

            $twilio = new Client(config('app.TWILIO_AUTH_SID'), config('app.TWILIO_AUTH_TOKEN'));

            // Fetch channel or create a new one if it doesn't exist
            try {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channelInfo->channel_unique_name)
                    ->fetch();
            } catch (\Twilio\Exceptions\RestException $e) {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels
                    ->create([
                        'uniqueName' => $channelInfo->channel_unique_name,
                        'type' => 'private',
                    ]);
            }

            // Add first user to the channel
            try {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channelInfo->channel_unique_name)
                    ->members($authUser->email)
                    ->fetch();

            } catch (\Twilio\Exceptions\RestException $e) {
                $member = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channelInfo->channel_unique_name)
                    ->members
                    ->create($authUser->email);
            }

            // Add second user to the channel
            try {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channelInfo->channel_unique_name)
                    ->members($otherUser->email)
                    ->fetch();

            } catch (\Twilio\Exceptions\RestException $e) {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channelInfo->channel_unique_name)
                    ->members
                    ->create($otherUser->email);
            }
        } else {
            return view('panel.chat.members', compact('otherUser', 'channelInfo', 'channels'));
        }

        return view('panel.chat.index', compact('otherUser', 'channelInfo', 'channels'));
    }

    public function updateConnectedStatus(Request $request)
    {
        $channel = Channel::find($request->channelId);
        $channel->is_connected = $request->status;
        $channel->save();

        return response()->json(['status' => true]);
    }

    public function trashUser(Request $request)
    {
        $authUserProfile = $request->user()->profile;
        $trashUserIds = [];
        if (isset($authUserProfile->trash_buddies)) {
            $trashUserIds = json_decode($authUserProfile->profile->trash_buddies);
        }
        array_push($trashUserIds, $request->trashId);
        $authUserProfile->trash_buddies = json_encode($trashUserIds);
        $authUserProfile->save();

        return response()->json(['status' => true, 'success' => 'This Member successfully deleted']);
    }
}

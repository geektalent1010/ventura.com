<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Invite;
use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

class TeamsController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('app.TWILIO_AUTH_SID'), config('app.TWILIO_AUTH_TOKEN'));
    }

    public function index()
    {
        $authUser = auth()->user();
        $teams = Team::where('user_id', '=', $authUser->id)->get();

        return view('panel.teams.own', compact('teams', 'authUser'));
    }

    public function show()
    {
        $data['user'] = $authUser = auth()->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $data['friends'] = User::whereIn('id', $friendIds)->get();

        return view('panel.teams.create', $data);
    }

    public function edit($teamId)
    {
        $authUser = auth()->user();
        $friendIds = Friend::where('user_id', '=', $authUser->id)->pluck('connected_user_id')->toArray();
        $data['friends'] = User::whereIn('id', $friendIds)->get();
        $data['team'] = Team::find($teamId);
        if ( ! isset($data['team'])) {
            return redirect()->route('team.create.index')->with('error', 'Team is not exist');
        }
        $data['unbannedUserIds'] = $data['team']->members->where('is_banned', '<>', 1)->pluck('user_id')->toArray();
        $bannedMemberIds = $data['team']->members->where('is_banned', 1)->pluck('id')->toArray();
        $data['invites'] = Invite::whereIn('member_id', $bannedMemberIds)->pluck('user_id')->toArray();

        return view('panel.teams.edit', $data);
    }

    public function showOwnTeams()
    {
        $authUser = auth()->user();
        $teams = Team::where('user_id', '=', $authUser->id)->get();

        return view('panel.teams.own', compact('teams', 'authUser'));
    }

    public function showFriendsTeams()
    {
        $authUser = auth()->user();
        $invites = Invite::where('user_id', '=', $authUser->id)->where('is_active', '=', 1)->get();
        $members = Member::whereHas('team', function ($query) use ($authUser): void {
            $query->where('user_id', '<>', $authUser->id);
        })
            ->where('user_id', $authUser->id)->where('is_banned', '<>', 1)->get();

        return view('panel.teams.friends', compact('members', 'invites', 'authUser'));
    }

    public function chat($id)
    {
        $authUser = auth()->user();

        $channelInfo = null;
        if ( ! $id) {
            $channelInfo = Team::where('user_id', '=', $authUser->id)->first();
            $member = Member::where('user_id', '=', $authUser->id)->where('is_banned', '<>', 1)->orderBy('created_at', 'desc')->first();
            if ( ! isset($channelInfo) && isset($member)) {
                $channelInfo = $member->team;
            }
        } else {
            $channelInfo = Team::find($id);
        }

        if ( ! isset($channelInfo)) {
            return redirect()->route('teams.index');
        }
        $data['channelInfo'] = $channelInfo;

        $twilio = new Client(config('app.TWILIO_AUTH_SID'), config('app.TWILIO_AUTH_TOKEN'));

        try {
            $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($channelInfo->channel_unique_name)
                ->members($authUser->username)
                ->fetch();

        } catch (RestException $e) {
            $member = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($channelInfo->channel_unique_name)
                ->members
                ->create($authUser->username);
        }

        return view('panel.teams.chat', $data);
    }

    public function createTeamChatRoom(Request $request)
    {
        $authUser = auth()->user();
        $currentDateTime = new DateTime();
        $currentDateTime = $currentDateTime->getTimestamp();
        $uniqueName = 'team_chatroom_' . $authUser->id . '_' . $currentDateTime . uniqid();

        $teamInfo = Team::where('channel_unique_name', '=', $uniqueName)->first();

        $twilio = new Client(config('app.TWILIO_AUTH_SID'), config('app.TWILIO_AUTH_TOKEN'));

        if (isset($teamInfo)) {
            try {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($uniqueName)
                    ->fetch();
            } catch (RestException $e) {
                $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels
                    ->create([
                        'friendlyName' => $uniqueName,
                        'uniqueName' => $uniqueName,
                        'createdBy' => $authUser->username,
                    ]);
            }

            // Add Admin user to the channel
            try {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channel->sid)
                    ->members($authUser->username)
                    ->fetch();

            } catch (RestException $e) {
                $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channel->sid)
                    ->members
                    ->create($authUser->username, [
                        'roleSid' => config('app.MIX_CHANNEL_ADMIN_ROLE_SID'),
                    ]);
            }

            return response()->json(['status' => true, 'exist' => true]);
        }
        $team = Team::create([
            'user_id' => $authUser->id,
            'channel_unique_name' => $uniqueName,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Member::create([
            'team_id' => $team->id,
            'user_id' => $authUser->id,
        ]);

        // Fetch channel or create a new one if it doesn't exist
        try {
            $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($uniqueName)
                ->fetch();
        } catch (RestException $e) {
            $channel = $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels
                ->create([
                    'friendlyName' => $uniqueName,
                    'uniqueName' => $uniqueName,
                    'createdBy' => $authUser->username,
                ]);
        }

        // Add Admin user to the channel
        try {
            $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($channel->sid)
                ->members($authUser->username)
                ->fetch();

        } catch (RestException $e) {
            $twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($channel->sid)
                ->members
                ->create($authUser->username, [
                    'roleSid' => config('app.MIX_CHANNEL_ADMIN_ROLE_SID'),
                ]);
        }

        return response()->json(['status' => true, 'exist' => false]);

    }

    public function updateTeamInfo(Request $request)
    {
        $team = Team::find($request->teamId);
        $team->name = $request->name;
        $team->description = $request->description;
        $team->save();

        return response()->json(['status' => true]);
    }

    public function ban(Request $request)
    {
        $member = Member::where('team_id', '=', $request->teamId)->where('user_id', '=', $request->userId)->first();
        if (isset($member)) {
            $requestInfo = Invite::where('member_id', '=', $member->id)->where('user_id', '=', $request->userId)->first();
            if (isset($requestInfo)) {
                $requestInfo->delete();
            }
            $member->is_banned = 1;
            $member->save();
        } else {
            return response()->json(['status' => false, 'message' => 'Member is not exist']);
        }
        $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
            ->channels($member->team->channel_unique_name)
            ->members($member->user->username)
            ->update([
                'roleSid' => config('app.MIX_CHANNEL_BANNED_ROLE_SID'),
            ]);

        return response()->json(['status' => true, 'message' => 'Member banned']);
    }

    public function unban(Request $request)
    {
        $user = User::find($request->userId);
        $member = Member::where('team_id', '=', $request->teamId)->where('user_id', '=', $request->userId)->first();
        if (isset($member)) {
            // $member->is_banned = 0;
            // $member->save();
            Invite::create([
                'requester' => $request->user()->id,
                'user_id' => $request->userId,
                'member_id' => $member->id,
            ]);

            $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                ->channels($member->team->channel_unique_name)
                ->members($user->username)
                ->update([
                    'roleSid' => config('app.MIX_CHANNEL_MEMBER_ROLE_SID'),
                ]);
        } else {
            $team = Team::find($request->teamId);
            $member = Member::create([
                'team_id' => $request->teamId,
                'user_id' => $request->userId,
                'is_banned' => 1,
            ]);
            Invite::create([
                'requester' => $request->user()->id,
                'user_id' => $request->userId,
                'member_id' => $member->id,
            ]);

            try {
                $channel = $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($team->channel_unique_name)
                    ->fetch();
            } catch (RestException $e) {
                $channel = $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels
                    ->create([
                        'friendlyName' => $team->channel_unique_name,
                        'uniqueName' => $team->channel_unique_name,
                        'createdBy' => $user->username,
                    ]);
            }

            // Add Admin user to the channel
            try {
                $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channel->sid)
                    ->members($user->username)
                    ->fetch();

            } catch (RestException $e) {
                $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($channel->sid)
                    ->members
                    ->create($user->username, [
                        'roleSid' => config('app.MIX_CHANNEL_MEMBER_ROLE_SID'),
                    ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'User ia added',
        ]);
    }

    public function accept(Request $request)
    {
        $requestInfo = Invite::find($request->request_id);
        if (isset($requestInfo)) {
            $member = $requestInfo->inviteMember;
            if (isset($member)) {
                $member->is_banned = 0;
                $member->save();

                $this->twilio->chat->v2->services(config('app.TWILIO_SERVICE_SID'))
                    ->channels($member->team->channel_unique_name)
                    ->members($requestInfo->user->username)
                    ->update([
                        'roleSid' => config('app.MIX_CHANNEL_MEMBER_ROLE_SID'),
                    ]);
            } else {
                return response()->json(['status' => false, 'message' => 'Member is not exist']);
            }
            $requestInfo->delete();

            return response()->json(['status' => true, 'message' => 'The request successfully accepted.']);
        }

        return response()->json(['status' => false, 'message' => 'Member is not exist']);
    }

    public function delete(Request $request)
    {
        $team = Team::find($request->id);
        $team->delete();

        return response()->json(['success' => 'Team Successfully Deleted']);
    }
}

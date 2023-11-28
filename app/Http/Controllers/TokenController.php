<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;

class TokenController extends Controller
{
    public function generate(Request $request)
    {
        $token = new AccessToken(
            config('app.TWILIO_AUTH_SID'),
            config('app.TWILIO_API_SID'),
            config('app.TWILIO_API_SECRET'),
            3600,
            $request->email
        );

        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid(config('app.TWILIO_SERVICE_SID'));
        $token->addGrant($chatGrant);

        return response()->json([
            'token' => $token->toJWT(),
        ]);
    }

    public function updateLastMessageSid(Request $request)
    {
        $channel = Channel::find($request->channelId);
        $channel->last_read_message_sid = $request->messageSid;
        $channel->last_message_readed_at = new Carbon($request->readedAt);
        $channel->save();

        return response()->json(['status' => true, 'result' => $channel]);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $expireTime = Carbon::now()->addMinute(5); // keep online for 1 min
            Cache::put('is_online' . auth()->user()->id, true, $expireTime);

            //Last Seen
            User::where('id', auth()->user()->id)->update(['last_seen' => Carbon::now()]);
        }

        return $next($request);
    }
}

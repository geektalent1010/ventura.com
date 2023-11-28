<?php

namespace App\Http\Middleware;

use Closure;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ($this->checkRole($role)) {
                //At least one role passes
                return $next($request);
            }
        }

        return redirect()->route('dashboard')->with('error', 'You cannot access this page');
    }

    private function checkRole($role)
    {
        switch ($role) {
            case 'individual': return auth()->user()->IsIndividual();
            case 'company': return auth()->user()->IsCompany();
            case 'coach': return auth()->user()->IsCoach();
            case 'admin': return auth()->user()->IsAdmin();
        }

        return false;
    }
}

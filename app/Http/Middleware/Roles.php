<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Roles 
{
    private function checkRole($role) {
        switch ($role) {
            case 'individual': return Auth::user()->IsIndividual();
            case 'company': return Auth::user()->IsCompany();
            case 'coach': return Auth::user()->IsCoach();
            case 'admin': return Auth::user()->IsAdmin();
        }
        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
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
}

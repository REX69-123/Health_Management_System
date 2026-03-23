<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // If the patient guard is the one that is logged in...
            if (Auth::guard('patient')->check()) {
                return redirect()->route('portal.dashboard');
            }

            // If the default (admin/staff) guard is logged in...
            if (Auth::guard($guard)->check()) {
                return redirect()->route('patients.index');
            }
        }

        return $next($request);
    }
}

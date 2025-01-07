<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckPendingStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = Auth::user();

        // Redirect rejected users to the rejected page
        if ($user && $user->status === 'rejected') {
            return redirect()->route('rejected.default'); // Replace with the actual route name for the rejected page
        }

        // Redirect users away from the pending page if their status is no longer 'pending'
        if ($user && $user->status !== 'pending' && $request->route()->getName() === 'pending.default' && $user->hasAnyRole(['hospitality', 'transport', 'superadmin'])) {
            return redirect()->route('dashboard'); // Replace with the appropriate route for approved users
        }

        // Redirect pending users to the pending page unless excluded
        if ($user && $user->status === 'pending' 
            && !$user->hasAnyRole(['hospitality', 'transport', 'superadmin']) 
            && !$this->isExcludedRoute($request)) {
            return redirect()->route('pending.default');
        }

        return $next($request);
    }

    /**
     * Check if the current route is excluded from the middleware logic.
     */
    private function isExcludedRoute(Request $request): bool
    {
        $excludedRouteNames = [
            'pending.default',  // Pending page
            'rejected.default', // Rejected page
        ];

        return in_array($request->route()->getName(), $excludedRouteNames, true);
    }
}

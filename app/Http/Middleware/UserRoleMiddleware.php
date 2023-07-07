<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Admin has access to all the roles
            if ($userRole == 'admin') {
                return $next($request);
            }

            // Editor has access to editor and user roles
            if ($userRole == 'editor' && ($role == 'user' || $role == 'editor')) {
                return $next($request);
            }

            // User has access to only user role
            if ($userRole == 'user' && $role == 'user') {
                return $next($request);
            }
        }
        return response()->json(["Bạn không có quyền để vào trang này!"]);
    }
}

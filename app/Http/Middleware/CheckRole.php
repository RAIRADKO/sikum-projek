<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }

        $admin = Auth::guard('admin')->user();

        foreach ($roles as $role) {
            if ($admin->role === $role) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
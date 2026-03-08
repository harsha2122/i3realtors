<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            // Update last login once per session
            if (! session()->has('last_login_tracked')) {
                $user->updateQuietly([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                ]);
                session(['last_login_tracked' => true]);
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Route;

class CheckIsInvited
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Route::is('home') && Cookie::has('invited') && Cookie::has('first_after_invite')) {
            return redirect()->route('game', '#open-invite-success')->withCookie(Cookie::forget('first_after_invite'));
        }

        return $next($request);
    }
}

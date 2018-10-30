<?php

namespace App\Http\Middleware;

use App\Models\User;

use Closure;

class StubIsEndGameTime
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
        if (isEndGameTime(User::GAME_ACTION_END_TIMESTAMP)) {
            return redirect()->route('stub');
        }

        return $next($request);
    }
}

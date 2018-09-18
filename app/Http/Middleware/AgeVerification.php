<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Route;

class AgeVerification
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
        if (in_array($_SERVER['HTTP_USER_AGENT'], [
              'facebookexternalhit/1.1 (+https://www.facebook.com/externalhit_uatext.php)',
              'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
              'Facebot',
            ])) {
            return $next($request);
        }

        if ($request->has('age_verified')) {
            return redirect()->route('home')->withCookie(Cookie::make('age_verified', true));
        }

        if (! Route::is('age') && ! Cookie::get('age_verified')) {
            return redirect()->route('age');
        }

        if (Route::is('age') && Cookie::get('age_verified')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

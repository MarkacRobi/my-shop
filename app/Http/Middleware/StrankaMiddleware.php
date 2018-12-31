<?php

namespace App\Http\Middleware;

use Closure;

class StrankaMiddleware
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
        if ($request->user() && $request->user()->role == 'STRANKA') {
            return $next($request);
        }
        else {
            return redirect('/')->with('error', 'Unauthorized');
        }
    }
}

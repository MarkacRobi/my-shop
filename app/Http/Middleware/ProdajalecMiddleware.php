<?php

namespace App\Http\Middleware;

use Closure;

class ProdajalecMiddleware
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
        if ($request->user() && $request->user()->role == 'PRODAJALEC') {
            return $next($request);
        }
        else {
            return redirect('/')->with('error', 'Unauthorized');
        }

    }
}

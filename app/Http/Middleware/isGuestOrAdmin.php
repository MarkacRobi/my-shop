<?php

namespace App\Http\Middleware;

use Closure;
use User;
use Illuminate\Support\Facades\Auth;

class isGuestOrAdmin
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
        if(Auth::guest())
        {
            return $next($request);
        }
        $user = Auth::user();
        if($user->role == 'ADMIN'){
            return $next($request);
        }

        return redirect('/')->with('error', 'Permission denied');
    }
}

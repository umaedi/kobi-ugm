<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!auth()->check() || auth()->user()->isAdmin !== 1) {
        //     return abort(403);
        // }
        // return $next($request);

        // if (Auth::user() && Auth::user()->isAdmin == 1) {
        // }
        if (Auth::user() &&  Auth::user()->isAdmin == 1) {
            return $next($request);
        }
        return abort(403);
    }
}

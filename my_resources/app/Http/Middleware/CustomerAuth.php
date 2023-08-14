<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    /**
     * Handle an incoming request for an Customer route - throw '403 Forbidden' if user does not have role of Customer
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::user()->hasRole('Customer')) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}

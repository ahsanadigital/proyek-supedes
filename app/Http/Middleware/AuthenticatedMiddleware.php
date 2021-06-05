<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()) {
            return redirect()->route('lurah.login');
        } elseif(auth()->check() AND auth()->user()->jabatan !== 'lurah') {
            return redirect()->route(auth()->user()->jabatan . ".home");
        }
        // dd(auth()->user()->jabatan);
        return $next($request);
    }
}

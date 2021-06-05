<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RTAuth
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
        } elseif(auth()->check() AND auth()->user()->jabatan !== 'ketua_rt') {
            return redirect()->route(auth()->user()->jabatan . ".home");
        }
        return $next($request);
    }
}

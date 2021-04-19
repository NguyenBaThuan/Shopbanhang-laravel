<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;

class Impersonate
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
        if(Session::has('impersonate')){
            Auth::onceUsingId(session('impersonate'));
        }
        return $next($request);
    }
}

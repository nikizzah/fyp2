<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hopLoggedin
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
        if(Session()->has('hoploginId') && (url('hoplogin')==$request->url() || (url('hopregister')==$request->url()))){
            return back();
        }
        return $next($request);
    }
}

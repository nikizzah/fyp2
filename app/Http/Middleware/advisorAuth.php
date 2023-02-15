<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class advisorAuth
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
        if(!Session()->has('advisorloginId')) {
            return redirect ('advisorlogin')->with('fail', 'Kindly login first');
        }
        return $next($request);
    }
}

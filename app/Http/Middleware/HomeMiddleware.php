<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HomeMiddleware
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
        $auth = auth()->user();
        //if(isset($auth) && $auth->role === 'admin'){
        if(isset($auth)){
            return $next($request);
        };
        return redirect()->route('home');
    }
}

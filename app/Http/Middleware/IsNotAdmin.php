<?php

namespace App\Http\Middleware;

use Closure;

class IsNotAdmin
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
        if ( ! $this->auth->user() )
        {
            return route('home'); 
        }
        return $next($request);
    }
}

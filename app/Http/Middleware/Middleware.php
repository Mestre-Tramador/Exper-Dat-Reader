<?php

namespace App\Http\Middleware;

abstract class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    abstract function handle(\Illuminate\Http\Request $request, \Closure $next, ?string $guard = null): mixed;
}

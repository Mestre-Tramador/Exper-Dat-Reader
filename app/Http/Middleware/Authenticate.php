<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate extends Middleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Verify the presence of a JSON Web Token and authenticate it.
     *
     * If any error is found, internally an Exception is raised and
     * a response with the 401 HTTP code is returned.
     */
    public function handle(\Illuminate\Http\Request $request, \Closure $next, ?string $guard = null): mixed
    {
        try
        {
            $this->auth->guard($guard)->authenticate();
        }
        catch(\Exception $e)
        {
            /**
             * Status to return on error message.
             *
             * @var string $status
             */
            $status = 'Authorization Token not found';

            if
            (
                $e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException ||
                $e instanceof \Illuminate\Auth\AuthenticationException
            )
            {
                $status = 'Token is Invalid';
            }

            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                $status = 'Token is Expired';
            }

            return response()->json(['status' => $status], 401);
        }

        return $next($request);
    }
}

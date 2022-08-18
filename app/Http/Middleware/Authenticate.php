<?php

namespace App\Http\Middleware;

use Closure, Exception;

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
     * @inheritDoc
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try
        {
            $this->auth->guard($guard)->authenticate();
        }
        catch(Exception $e)
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

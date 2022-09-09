<?php

#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2022  Mestre-Tramador
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
#endregion

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Middleware used to validate the JWT on the Request.
 */
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

            return $this->respondWithUnauthorized($status);
        }

        return $next($request);
    }
}

<?php

#region License
/**
 * Exper-Dat-Reader is a system to read encrypted .dat files and dump their data into .done.dat files.
 *  Copyright (C) 2023  Mestre-Tramador
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

use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * Middleware used to validate the JWT on the Request.
 *
 * @author Mestre-Tramador
 */
class Authenticate extends Middleware
{
    /**
     * The authentication guard factory instance.
     *
     * @var Auth $auth
     */
    protected Auth $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Auth $auth
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
     *
     * @param  Request     $request
     * @param  Closure     $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        ?string $guard = null
    ): mixed {
        try {
            $this->auth->guard($guard)->authenticate();
        } catch (Exception $e) {
            /**
             * Status to return on error message.
             *
             * @var string $status
             */
            $status = 'Authorization Token not found';

            if (
                $e instanceof TokenInvalidException ||
                $e instanceof AuthenticationException
            ) {
                $status = 'Token is Invalid';
            }

            if ($e instanceof TokenExpiredException) {
                $status = 'Token is Expired';
            }

            return $this->respondWithUnauthorized($status);
        }

        return $next($request);
    }
}

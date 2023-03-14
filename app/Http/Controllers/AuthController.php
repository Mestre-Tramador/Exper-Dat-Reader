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

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

/**
 * Controller to handle authentication requests of registering,
 * login and logout.
 *
 * @author Mestre-Tramador
 */
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register',
                'verify'
            ]
        ]);
    }

    /**
     * Register a new User on the Database and also grant it
     * a new Json Web Token.
     *
     * @return JsonResponse
     */
    public function register(): JsonResponse
    {
        $this->validate(
            request(),
            [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6'
            ]
        );

        try {
            /**
             * The new User to be created.
             *
             * @var User $user
             */
            $user = new User();

            $user->name = request('name');
            $user->email = request('email');
            $user->password = app('hash')->make(request('password'));

            $user->save();

            /**
             * The JWT for the created User.
             *
             * @var string $token
             */
            $token = auth()->fromUser($user);

            return $this->respondWithCreated(compact('user', 'token'));
        } catch (QueryException $e) {
            return $this->respondWithServerError('There was an error saving the User!');
        }
    }

    /**
     * Login into the API, getting a JWT for the use on the system.
     *
     * If there is already a User, then it's redirected to the main page.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $this->validate(
            request(),
            [
                'email' => 'required|string|email|max:100',
                'password' => 'required|string|min:6'
            ]
        );

        /**
         * The authentication class.
         *
         * @var \Tymon\JWTAuth\JWTAuth $auth
         */
        $auth = auth();

        if ($auth->user()) {
            return $this->respondWithAccepted('Already logged in');
        }

        try {
            /**
             * A generated Json Web Token for the User.
             *
             * @var string|null $token
             */
            $token = $auth->attempt(request(['email', 'password']));

            if (!$token) {
                return $this->respondWithUnauthorized();
            }

            return $this->respondWithOK([
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => $auth->user()
            ]);
        } catch (ModelNotFoundException $e) {
            return $this->respondWithUnauthorized('There is no User with this credentials registered!');
        }
    }

    /**
     * Logout of the system, revoking the JWT and
     * returning to the main page.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->respondWithOK(['message' => 'Successful logout']);
    }

    /**
     * Make a simple verification if there is a User
     * attached to the JWT.
     *
     * @return JsonResponse
     */
    public function verify(): JsonResponse
    {
        $this->validate(request(), ['token' => 'required|string']);

        /**
         * The authentication class.
         *
         * @var \Tymon\JWTAuth\JWTAuth $auth
         */
        $auth = auth();

        if ($auth->user()) {
            return $this->respondWithNoContent();
        }

        return $this->respondWithUnauthorized();
    }
}

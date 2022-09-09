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

namespace App\Http\Controllers;

use App\Models\User;

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
                'register'
            ]
        ]);
    }

    /**
     * Register a new User on the Database and also grant it
     * a new Json Web Token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $this->validate(
            request(),
            [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6'
            ]
        );

        try
        {
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
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return $this->respondWithServerError('There was an error saving the User!');
        }
    }

    /**
     * Login into the API, getting a JWT for the use on the system.
     *
     * If there is already a User, then it's redirected to the main page.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $this->validate(
            request(),
            [
                'email' => 'required|string|email|max:100',
                'password' => 'required|string|min:6'
            ]
        );

        if(auth()->user())
        {
            return $this->respondWithFound('/');
        }

        try
        {
            /**
             * A generated Json Web Token for the User.
             *
             * @var string|null $token
             */
            $token = auth()->attempt(request(['email', 'password']));

            if(!$token)
            {
                return $this->respondWithUnauthorized();
            }

            return $this->respondWithOK([
                'access_token' => $token,
                'token_type' => 'bearer'
            ]);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return $this->respondWithServerError('There is no User with this credentials registered!');
        }
    }

    /**
     * Logout of the system, revoking the JWT and
     * returning to the main page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->respondWithFound('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;

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

            return response()->json(compact('user', 'token'),201);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return $this->respondWithError('There was an error saving the User!');
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
            return redirect('/');
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

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer'
            ]);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return $this->respondWithError('There is no User with this credentials registered!');
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

        return redirect('/');
    }
}

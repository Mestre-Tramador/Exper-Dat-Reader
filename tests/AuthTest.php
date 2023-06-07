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

namespace Tests;

/**
 * Execute tests only related to Authentication.
 *
 * @author Mestre-Tramador
 */
final class AuthTest extends TestCase
{
    /**
     * Test the Register API Route.
     *
     * The test asserted when an User
     * is registered.
     *
     * @return void
     */
    public function test_register_route(): void
    {
        $this->register($this->userSample())
        ->seeJsonStructure([
            'token',
            'user' => [
                'id',
                'name',
                'email',
                'creation'
            ]
        ]);
    }

    /**
     * Test the Login and Logout API Routes.
     *
     * The test is asserted when a registered
     * User can login and logout.
     *
     * @return void
     */
    public function test_login_routes(): void
    {
        $user = $this->userSample();

        $this->register($user)
        ->post(
            '/api/login',
            [
                'email' => $user->email,
                'password' => $user->password
            ]
        )
        ->seeJsonStructure([
            'access_token',
            'token_type',
            'user' => [
                'id',
                'name',
                'email',
                'creation'
            ]
        ])
        ->post('/api/logout')
        ->seeStatusCode(200);
    }
}

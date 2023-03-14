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

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
$router->group(['prefix' => 'api'], function () use ($router): void {

    /*
    |----------------------------------------------------------
    | Auth
    |----------------------------------------------------------
    */
    $router->get('auth', 'AuthController@verify');
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');


    /*
    |----------------------------------------------------------
    | Dat
    |----------------------------------------------------------
    */
    $router->group(['prefix' => 'dat'], function () use ($router): void {
        $router->get('/', 'DatController@list');
        $router->get('/{id:^[0-9]*$}', 'DatController@read');
        $router->post('/', 'DatController@create');
        $router->put('/{id}', 'DatController@update');
        $router->delete('/{id}', 'DatController@delete');
    });


    /*
    |----------------------------------------------------------
    | DoneDat
    |----------------------------------------------------------
    */
    $router->group(['prefix' => 'dump'], function () use ($router): void {
        $router->get('/', 'DoneDatController@list');
        $router->get('/{id:^[0-9]*$}', 'DoneDatController@read');
        $router->get('/last', 'DoneDatController@last');
        $router->post('/', 'DoneDatController@create');
        $router->delete('/{id}', 'DoneDatController@delete');
    });

    /*
    |----------------------------------------------------------
    | Other
    |----------------------------------------------------------
    */
    $router->get('/', 'AppController@index');
    $router->get('/{route:.*}/', 'AppController@index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
$router->get('/', 'AppController@app');
$router->get('/{route:.*}/', 'AppController@index');

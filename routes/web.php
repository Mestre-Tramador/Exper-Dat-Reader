<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->group(['middleware' => 'auth:api'], function() use ($router) {
    $router->get('', function () {
        return app()->version();
    });
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$router->group(['prefix' => 'api'], function() use ($router) {

    /*
    |----------------------------------------------------------
    | Auth
    |----------------------------------------------------------
    */

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');


    /*
    |----------------------------------------------------------
    | Dat
    |----------------------------------------------------------
    */

    $router->get('dat', 'DatController@list');
    $router->get('dat/{id}', 'DatController@read');
    $router->post('dat', 'DatController@store');
    $router->put('dat/{id}', 'DatController@update');
    $router->delete('dat/{id}', 'DatController@delete');


    /*
    |----------------------------------------------------------
    | DoneDat
    |----------------------------------------------------------
    */

    $router->get('dump', 'DoneDatController@list');
    $router->get('dump/{id}', 'DoneDatController@read');
    $router->post('dump', 'DoneDatController@dump');
    $router->delete('dump/{id}', 'DoneDatController@delete');
});

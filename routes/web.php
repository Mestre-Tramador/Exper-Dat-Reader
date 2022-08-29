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

});

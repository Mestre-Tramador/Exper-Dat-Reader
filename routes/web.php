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
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->group(['middleware' => 'auth:api'], function() use ($router) {
        $router->post('logout', 'AuthController@logout');
    });
});

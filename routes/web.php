<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

    $router->group(['prefix' => 'dat'], function() use ($router) {
        $router->get('/', 'DatController@list');
        $router->get('/{id}', 'DatController@read');
        $router->post('/', 'DatController@create');
        $router->put('/{id}', 'DatController@update');
        $router->delete('/{id}', 'DatController@delete');
    });


    /*
    |----------------------------------------------------------
    | DoneDat
    |----------------------------------------------------------
    */

    $router->group(['prefix' => 'dump'], function() use ($router) {
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

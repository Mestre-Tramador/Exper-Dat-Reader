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

use App\Console\Kernel as Console;
use App\Exceptions\Handler;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\HasFile;
use App\Http\Middleware\ParsePUT;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Application;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;
use Laravel\Lumen\Routing\Router;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

/**
 * The folder magic path.
 *
 * @var string $dir
 */
$dir = __DIR__;

/**
 * The parent folder.
 *
 * @var string $parent
 */
$parent = dirname($dir);

require_once "{$dir}/../vendor/autoload.php";

(new LoadEnvironmentVariables($parent))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/
/**
 * The Application.
 *
 * @var Application $app
 */
$app = new Application($parent);

$app->withFacades();
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
*/
$app->singleton(ExceptionHandler::class, Handler::class);
$app->singleton(Kernel::class, Console::class);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
*/
$app->configure('app');
$app->configure('jwt');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/
$app->middleware([
    ParsePUT::class
]);

$app->routeMiddleware([
    'auth' => Authenticate::class,
    'file' => HasFile::class
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
*/
$app->register(AuthServiceProvider::class);
$app->register(LumenServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/
$app->router->group(
    ['namespace' => 'App\Http\Controllers'],
    fn(Router $router): bool => require "{$dir}/../routes/web.php"
);

return $app;

<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('foo', function () {
    return response()->json(['message' => 'success']);
});

$router->get('user/{id}', [ // Required Parameters
    'as' => 'user', 'uses' => 'ExampleController@show'
]);

$router->get('role[/{role_name:[A-Za-z]+}]', function ($role_name = null) { // Optional Parameters
    return $role_name;
});

$router->get('profile', [
    'as' => 'profile', 'uses' => 'ExampleController@showProfile'
]);

$router->get('search', [
    'as' => 'search', 'uses' => 'ExampleController@index'
]);
<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => '/v1', 'as' => 'api.'], function () use ($router) {
//    users route
    $router->get('/users', 'UserController@index');
    $router->get('/users/{user}', 'UserController@show');
});

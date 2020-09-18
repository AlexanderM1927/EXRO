<?php

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
$router->post('/login', "AuthController@login");
$router->post('/logout', "UserController@logout");

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/my-user', "UserController@getUser");
    $router->get('/user/{id}', "UserController@getUserById");
    $router->get('/users', "UserController@getUsers");
    $router->post('/register', "UserController@register");
});

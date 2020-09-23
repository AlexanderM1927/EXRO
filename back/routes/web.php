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
    // Users routes
    $router->get('/my-user', "UserController@getUser");
    $router->get('/user/{id}', "UserController@getUserById");
    $router->post('/user/{id}', "UserController@modifyUserById");
    $router->delete('/user/{id}', "UserController@deleteUserById");
    $router->get('/users', "UserController@getUsers");
    $router->get('/clients', "UserController@getClients");

    // Variables routes
    $router->get('/vars', "VariableController@getVars");
    $router->get('/var/{id}', "VariableController@getVarById");
    $router->post('/var', "VariableController@newVar");
    $router->delete('/var/{id}', "VariableController@deleteVarById");
    $router->post('/var/{id}', "VariableController@modifyVarById");

    //Proyectos routes
    $router->get('/projects', "ProjectController@getProjects");
    $router->get('/project/{id}', "ProjectController@getProjectsById");
    $router->post('/projects', "ProjectController@newProject");
    $router->delete('/project/{id}', "ProjectController@deleteProjectById");
    $router->post('/project/{id}', "ProjectController@modifyProjectById");

    //Variablesprojects routes
    $router->post('/variablesprojects', "VariablesprojectsController@newVariablesprojects");
    $router->get('/variablesprojects/{id}', "VariablesprojectsController@getVariablesByProject");
    $router->delete('/variablesprojects/{id}', "VariablesprojectsController@deleteVariableProjectById");



    $router->post('/register', "UserController@register");
});

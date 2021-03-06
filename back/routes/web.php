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
$router->post('/recovery', "AuthController@recoveryPassword");
$router->post('/changepassword', "AuthController@updatePassword");
$router->post('/logout', "UserController@logout");

//images
$router->get('/images/{id}', "ImageController@getImg");

$router->group(['middleware' => 'auth'], function () use ($router) {
    // Users routes
    $router->get('/my-user', "UserController@getUser");
    $router->get('/user/{id}', "UserController@getUserById");
    $router->post('/user/{id}', "UserController@modifyUserById");
    $router->delete('/user/{id}', "UserController@deleteUserById");
    $router->get('/users', "UserController@getUsers");
    $router->get('/clients', "UserController@getClients");
    $router->get('/engineers', "UserController@getEngineers");

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

    //VariablesProjects routes
    $router->post('/variablesprojects', "VariablesProjectsController@newVariablesProjects");
    $router->get('/variablesprojects/{id}', "VariablesProjectsController@getVariablesByProject");
    $router->delete('/variablesprojects/{id}', "VariablesProjectsController@deleteVariableProjectById");

    //EngineersProjects routes
    $router->post('/engineersProjects', "EngineersProjectsController@newEngineerProject");
    $router->get('/engineersProjects/{id}', "EngineersProjectsController@getEngineersByProject");
    $router->delete('/engineersProjects/{id}', "EngineersProjectsController@deleteEngineerProjectById");

    //Reports routes
    $router->post('/report', "ReportController@createReport");
    $router->get('/reports', "ReportController@getReports");
    $router->get('/report/{id}', "ReportController@getReportById");
    $router->delete('/report/{id}', "ReportController@deleteReport");
    $router->post('/modify_report', "ReportController@editReport");

    //statics
    $router->post('/getstats', "StatisticController@getStats");

    //chats
    $router->get('/chats', "ChatController@getChats");
    $router->get('/chat/{id}', "ChatController@getChatById");
    $router->post('/chat', "ChatController@newChat");
    $router->post('/chat/{id}', "ChatController@answerChat");
    $router->delete('/chat/{id}', "ChatController@deleteChatById");

    //users
    $router->post('/register', "UserController@register");
});

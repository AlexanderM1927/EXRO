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
    $router->get('/users-childrens', "UserController@getChildrens");
    $router->get('/clients', "UserController@getClients");
    $router->get('/engineers', "UserController@getEngineers");
    $router->get('/technicals', "UserController@getTechnicals");
    $router->get('/managers', "UserController@getManagers");
    $router->post('/register', "UserController@register");
    $router->post('/register-children', "UserController@registerChildren");

    // Variables routes
    $router->get('/vars', "VariableController@getVars");
    $router->get('/var/{id}', "VariableController@getVarById");
    $router->post('/var', "VariableController@newVar");
    $router->delete('/var/{id}', "VariableController@deleteVarById");
    $router->post('/var/{id}', "VariableController@modifyVarById");

    //Proyectos routes
    $router->get('/projects', "ProjectController@getProjects");
    $router->get('/projects-client/{id}', "ProjectController@getProjectsByClientId");
    $router->get('/project/{id}', "ProjectController@getProjectsById");
    $router->post('/projects', "ProjectController@newProject");
    $router->delete('/project/{id}', "ProjectController@deleteProjectById");
    $router->post('/project/{id}', "ProjectController@modifyProjectById");

    //VariablesProjects routes
    $router->post('/variablesprojects', "VariablesProjectsController@newVariablesProjects");
    $router->post('/variablesprojects/{id}', "VariablesProjectsController@updateVariablesProjects");
    $router->get('/variablesprojects/{id}', "VariablesProjectsController@getVariablesByProject");
    $router->delete('/variablesprojects/{id}', "VariablesProjectsController@deleteVariableProjectById");

    //EngineersProjects routes
    $router->post('/engineersProjects', "EngineersProjectsController@newEngineerProject");
    $router->get('/engineersProjects/{id}', "EngineersProjectsController@getEngineersByProject");
    $router->get('/technicalsProjects/{id}', "EngineersProjectsController@getTechnicalsByProject");
    $router->get('/managersProjects/{id}', "EngineersProjectsController@getManagersByProject");
    $router->delete('/engineersProjects/{id}', "EngineersProjectsController@deleteEngineerProjectById");

    //Reports routes
    $router->post('/report', "ReportController@createReport");
    $router->get('/reports', "ReportController@getReports");
    $router->get('/report/{id}', "ReportController@getReportById");
    $router->delete('/report/{id}', "ReportController@deleteReport");
    $router->post('/modify_report', "ReportController@editReport");

    //statics
    $router->post('/getstats', "StatisticController@getStats");
    $router->post('/getstatsgrilla', "StatisticController@getStatsGrilla");

    //chats
    $router->get('/chats', "ChatController@getChats");
    $router->get('/chat/{id}', "ChatController@getChatById");
    $router->post('/chat', "ChatController@newChat");
    $router->post('/chat/{id}', "ChatController@answerChat");
    $router->delete('/chat/{id}', "ChatController@deleteChatById");

    //logs
    $router->get('/logs/{numItemsPerPage}/{page}[/{search}]', "AppLogController@getAppLogs");

    //settings
    $router->get('/settings', "SettingController@getSettings");
    $router->get('/setting/{map}', "SettingController@getSettingByMap");
    $router->post('/setting/{id}', "SettingController@updateSetting");
});

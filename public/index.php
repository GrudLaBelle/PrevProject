<?php

use Router\Router;
use App\Exceptions\NotFoundException;

// library manager
require '../vendor/autoload.php';

// script manager
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

// gestionnaire des scripts
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

// manager of the connection to the DB
define('DB_NAME', 'antoinebarre_prevproject');
define('DB_HOST', 'db.3wa.io');
define('DB_USER', 'antoinebarre');
define('DB_PWD', 'e16741166c54eb7e57bb51a9d3151fbc');

$router = new Router($_GET['route']);

// FRONT CONTROLLER
$router -> get('/', 'App\Controllers\FrontController@home');
$router -> get('/about', 'App\Controllers\FrontController@about');
$router -> get('/process', 'App\Controllers\FrontController@process');
$router -> get('/legal_notice', 'App\Controllers\FrontController@legalNotice');

// USER CONTROLLER
$router->get('/sign_up', 'App\Controllers\UserController@signUp');
$router->post('/sign_up/post', 'App\Controllers\UserController@signUpUser');
$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login/post', 'App\Controllers\UserController@loginUser');
$router->get('/logout/', 'App\Controllers\UserController@logout');
$router -> get('/profile/:user_id', 'App\Controllers\UserController@showFormUser');
$router -> post('/profile/update/post/:user_id', 'App\Controllers\UserController@updateUser');
$router -> get('/profile/delete/post/:user_id', 'App\Controllers\UserController@deleteUser');

// ENTERPRISE FORM CONTROLLER
$router -> get('/enterprise/:user_id', 'App\Controllers\FormController@showFormEnterprise');
$router -> post('/enterprise/post/:user_id', 'App\Controllers\FormController@handleForm');
$router -> get('/compare_table/:user_id', 'App\Controllers\TableController@showTable');

// USERS LIST CONTROLLER
$router -> get('/userslist/:user_id', 'App\Controllers\UsersListController@showUsersList');
$router -> get('/manage_user/delete/:user_id', 'App\Controllers\UsersListController@deleteUser');
$router -> get('/manage_user/update/:user_id', 'App\Controllers\UsersListController@showFormUser');
$router -> post('/manage_user/update/post/:user_id', 'App\Controllers\UsersListController@updateUser');

// gestionnaire de l'existance de routes
try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}

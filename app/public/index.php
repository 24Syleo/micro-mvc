<?php

use App\core\Router;
use App\services\Config;
use App\services\FlashMessage;
use App\middlewares\CsrfMiddleware;
use App\middlewares\RoleMiddleware;

require_once '../vendor/autoload.php';
require_once '../src/services/helpers.php';

session_start();
Config::getEnv();
define('ROOT', dirname(__DIR__));
define('VIEWS_PATH', ROOT . '/views/');

$router = new Router();

// Middleware global
$router->use(CsrfMiddleware::class);

//routes publiques GET
$router->get('/', 'HomeController#index', 'home');
$router->get('/login', 'AuthController#login', 'login');
$router->get('/error', 'ErrorController#index', 'error');


//routes publiques POST
$router->post('/user/create', 'AuthController#create', 'user_create');
$router->post('/auth/login', 'AuthController#auth', 'auth_login');

try {
    $router->dispatch();
} catch (Exception $e) {
    FlashMessage::set($e->getMessage(), 'danger');
    $router->redirect('/error');
}

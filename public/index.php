<?php

session_start();

define('BASE_DIR', dirname(__FILE__) . '/..');
define('PUBLIC_DIR', dirname(__FILE__));
define('IMG_DIR', PUBLIC_DIR . '/img');
define('SOURCE_DIR', BASE_DIR . '/src');
define('MODEL_DIR', SOURCE_DIR . '/Models');
define('VIEW_DIR', SOURCE_DIR . '/Views');
define('CONTROLLER_DIR', SOURCE_DIR . '/Controllers');


require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

use App\Route;
use App\Router;
use App\Controllers\Controller;
use App\Controllers\ExercisesController;

<<<<<<< Updated upstream
$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER["REQUEST_METHOD"];

if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
=======
switch ($request) {
    case '':
    case '/':
        include VIEW_DIR . '/home.php';
        break;
    case '/exercises/new':
        include VIEW_DIR . '/create.php';
        break;
    case '/exercises/answering':
        include VIEW_DIR . '/Take.php';
        break;
    default:
        http_response_code(404);
        include VIEW_DIR . '/404.php';
        case '/exercises/NewField':
            include VIEW_DIR . '/Fields.php';
            break;
>>>>>>> Stashed changes
}

include_once SOURCE_DIR . '/Router.php';
$router = new Router([$route, $method]);

$router->addRoute(new Route('GET', '/', [Controller::class, '/home.php']));
$router->addRoute(new Route('GET', '/exercises/new', [Controller::class, '/create.php']));
$router->addRoute(new Route('GET', '/exercises/answering', [Controller::class, '/Take.php']));
$router->addRoute(new Route('POST', '/exercises/new', [ExercisesController::class, 'create']));

$router->matchRoute();


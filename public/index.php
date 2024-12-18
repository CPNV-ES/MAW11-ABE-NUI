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

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER["REQUEST_METHOD"];

if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
}

include_once SOURCE_DIR . '/Router.php';
$router = new Router([$route, $method]);

// Ajout des routes
$router->addRoute(new Route('GET', '/', [Controller::class, '/home.php']));
$router->addRoute(new Route('GET', '/exercises', [ExercisesController::class, 'index'])); // Ajout de cette ligne
$router->addRoute(new Route('GET', '/exercises/new', [Controller::class, '/create.php']));
$router->addRoute(new Route('GET', '/exercises/answering', [ExercisesController::class, 'showAnswering']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields', [Controller::class, '/fields.php']));
$router->addRoute(new Route('POST', '/exercises', [ExercisesController::class, 'create']));
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/status', [ExercisesController::class, 'updateStatus']));

$router->matchRoute();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

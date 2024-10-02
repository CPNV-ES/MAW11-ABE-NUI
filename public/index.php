<?php

session_start();

define('BASE_DIR', dirname(__FILE__) . '/..');
define('SOURCE_DIR', BASE_DIR . '/src');
define('MODEL_DIR', SOURCE_DIR . '/Models');
define('VIEW_DIR', SOURCE_DIR . '/Views');
define('CONTROLLER_DIR', SOURCE_DIR . '/Controllers');


require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

$request = $_SERVER['REQUEST_URI'];

use App\Controllers\ExercisesController;

switch ($request) {
    case '':
    case '/':
        include VIEW_DIR . '/home.php';
        break;
    case '/exercises':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require CONTROLLER_DIR . '/ExercisesController.php';

            ExercisesController::create();
        }
    case '/exercises/new':
        include VIEW_DIR . '/create.php';
        break;
    case '/exercises/answering':
        include VIEW_DIR . '/Take.php';
        break;
    default:
        http_response_code(404);
        include VIEW_DIR . '/404.php';
}

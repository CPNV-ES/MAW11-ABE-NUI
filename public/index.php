<?php

session_start();

define('BASE_DIR', dirname(__FILE__) . '/..');
define('PUBLIC_DIR', dirname(__FILE__));
define('IMG_DIR', PUBLIC_DIR . '/img');
define('SOURCE_DIR', BASE_DIR . '/src');
define('MODEL_DIR', SOURCE_DIR . '/models');
define('VIEW_DIR', SOURCE_DIR . '/views');

require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/':
        include VIEW_DIR . '/home.php';
        break;
    case '/exercises/new':
        include VIEW_DIR . '/NewExercise.php';
        break;
    case '/exercises/answering':
        include VIEW_DIR . '/AnsweringExercises.php';
        break;
    case '/exercises':
        include VIEW_DIR . '/Exercises.php';
        break;
    default:
        http_response_code(404);
        include VIEW_DIR . '/404.php';
}

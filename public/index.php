<?php

session_start();

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');
define('VIEW_DIR', SOURCE_DIR.'/views');

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '':
    case '/':
        require VIEW_DIR.'/home.php';
        break;

    default:
        http_response_code(404);
        require VIEW_DIR.'/404.php';
}
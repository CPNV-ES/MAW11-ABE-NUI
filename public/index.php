<?php

session_start();

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');
define('VIEW_DIR', SOURCE_DIR.'/views');


require VIEW_DIR.'/home.php';
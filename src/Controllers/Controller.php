<?php

namespace App\Controllers;

use App\Router\Router;
use App\Database\DBConnection;

abstract class Controller {
    
    protected DBConnection $dbConnection;
    protected Router $router;
    
    public function __construct()
    {
        $this->dbConnection = DBConnection::getInstance();
        $this->router = Router::getInstance();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function view(string $path, array $params = null): void
    {
        ob_start();
        require TEMPLATES_DIR . $path . '.php';
        $content = ob_get_clean();
        require TEMPLATES_DIR . 'layout.php';
    }

} 



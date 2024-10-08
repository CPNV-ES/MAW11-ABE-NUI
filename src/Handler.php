<?php

namespace App;

use App\Controllers\Controller;

class Handler
{

    private $controller;
    private $method;

    public function __construct($routeData)
    {
        $this->controller = $routeData[0];
        $this->method = $routeData[1];
    }

    public function handle()
    {
        if (class_exists($this->controller)) {
            $controllerInstance = new $this->controller;

            if ($this->controller == Controller::class) {
                if (file_exists(VIEW_DIR . $this->method)) {
                    call_user_func([$this->controller, "view"], $this->method);
                    return;
                }
            }

            if (method_exists($controllerInstance, $this->method)) {
                call_user_func([$controllerInstance, $this->method]);
            }
        }
    }
}

<?php

namespace App;

use Exception;

class Router
{
    private $routes;
    private $routeRequest;

    public function __construct($request)
    {
        $this->routes = [];
        $this->routeRequest = $request;
    }

    public function addRoute($route)
    {
        $this->routes[] = $route;
    }

    public function matchRoute()
    {
        $routeRequest = $this->routeRequest;

        foreach ($this->routes as $route) {
            if ($route->matchesPath($routeRequest[0])) {
                if ($route->matchesMethod($routeRequest[1])) {
                    $handler = new Handler($route->getHandler());
                    $handler->handle();
                    return;
                }
            }
        }
        throw new Exception('Route not found');
    }
}

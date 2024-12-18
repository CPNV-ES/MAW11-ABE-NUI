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

        // Debugging: Affiche la route demandée et la méthode
        echo 'Requested route: ' . $routeRequest[0] . ' with method: ' . $routeRequest[1] . PHP_EOL;

        foreach ($this->routes as $route) {

            // Debugging: Affiche chaque route vérifiée
            echo 'Checking route: ' . $route->getPath() . PHP_EOL;

            if ($route->matchesMethod($routeRequest[1])) {

                if ($route->matchesPath($routeRequest[0])) {

                    $handler = new Handler($route->getHandler());

                    $handler->handle();

                    return;
                }

                $routeArray = explode("/", $route->getPath());
                $routeArray = array_filter($routeArray);

                $requestRouteArray = explode("/", $routeRequest[0]);
                $requestRouteArray = array_filter($requestRouteArray);

                if (count($requestRouteArray) == count($routeArray)) {

                    $parameters = [];
                    $pathRequestIsValid = false;

                    foreach ($requestRouteArray as $key => $pathSegment) {

                        if ($pathSegment != $routeArray[$key]) {

                            if (preg_match('/{(.*?)}/', $routeArray[$key], $matches)) {

                                $parameters[$matches[1]] = $pathSegment;
                                $pathRequestIsValid = true;

                            } else {

                                $pathRequestIsValid = false;
                                break;

                            }
                        }
                    }

                    if ($pathRequestIsValid) {

                        $handler = new Handler($route->getHandler());

                        $handler->handle($parameters);

                        return;
                    }
                }
            }
        }
        throw new Exception('Route not found');
    }
}

<?php

namespace App\Router; // Defines the namespace for the router

use PharIo\Manifest\InvalidUrlException; // Imports the InvalidUrlException class

class Router
{
    private static ?Router $instance = null; // Private static property to hold the single instance of Router

    public array $routes; // Public property to store the routes

    private function __construct() {} // Private constructor to prevent multiple instances

    /**
     * Gets the single instance of the Router class
     *
     * @return Router
     */
    public static function getInstance(): Router
    {
        if (self::$instance == null) {
            self::$instance = new Router(); // Creates a new instance if not already created
        }
        return self::$instance; // Returns the single instance
    }

    /**
     * Registers a GET route
     *
     * @param string $name
     * @param Route  $route
     *
     * @return void
     */
    public function get(string $name, Route $route): void
    {
        $this->routes['GET'][$name] = $route; // Adds the route to the GET routes array
    }

    /**
     * Registers a POST route
     *
     * @param string $name
     * @param Route  $route
     *
     * @return void
     */
    public function post(string $name, Route $route): void
    {
        $this->routes['POST'][$name] = $route; // Adds the route to the POST routes array
    }

    /**
     * Runs the router to match and execute the appropriate route
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) { // Iterates through the routes for the current request method
            if ($route->matches($_SERVER['REQUEST_URI'])) { // Checks if the route matches the current URI
                $route->execute(); // Executes the matched route
            }
        }
    }

    /**
     * Generates a URL for the given route name and parameters
     *
     * @param string $name
     * @param array  $params
     * @param string $query
     *
     * @return string
     */
    public function generateUrl(string $name, array $params = [], string $query = ''): string
    {
        foreach ($this->routes as $routes) {
            if (isset($routes[$name])) {
                $path = '/' . $routes[$name]->getPath(); // Gets the path for the route

                foreach ($params as $key => $param) {
                    $path = str_replace(':' . $key, $param, $path); // Replaces path parameters with actual values
                }

                return $path . ($query ? '?' . $query : ''); // Returns the complete URL with query string if provided
            }
        }
        throw new InvalidUrlException(); // Throws an exception if the route is not found
    }

    /**
     * Redirects to the given route name with parameters
     *
     * @param string $name
     * @param array  $params
     *
     * @return void
     */
    public function redirect(string $name, array $params = []): void
    {
        $location = $this->generateUrl($name, $params); // Generates the URL for redirection
        header("Location: {$location}"); // Sends the HTTP header to redirect
    }
}

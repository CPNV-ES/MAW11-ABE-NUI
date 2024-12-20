<?php

namespace App\Router; // Defines the namespace for the router

class Route
{
    protected string $path; // Protected property to store the route path
    protected string $controller; // Protected property to store the controller name
    protected string $method; // Protected property to store the method name
    protected array  $matches; // Protected property to store the matches from the URL

    /**
     * Constructor to initialize the Route object
     *
     * @param string $path
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $path, string $controller, string $method)
    {
        $this->path = trim($path, '/'); // Sets the path, trimming any leading/trailing slashes
        $this->controller = $controller; // Sets the controller name
        $this->method = $method; // Sets the method name
    }

    /**
     * Gets the path of the route
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path; // Returns the path
    }

    /**
     * Checks if the given URL matches the route
     *
     * @param string $url
     *
     * @return bool
     */
    public function matches(string $url): bool
    {
        $url_components = parse_url($url); // Parses the URL into components
        $path = preg_replace('#:([\w]+)#', '([0-9]+)', $this->path); // Replaces placeholders in the path with regex to match numbers
        $pathToMatch = '/^\/' . str_replace('/', '\/', $path) . '$/'; // Prepares the regex pattern to match the path

        if (preg_match($pathToMatch, $url_components['path'], $matches)) { // Checks if the URL path matches the pattern
            $this->matches = $matches; // Stores the matches
            if (isset($url_components['query'])) {
                $this->matches[] = $url_components['query']; // Adds the query component to matches if present
            }
            return true; // Returns true if matches
        } else {
            return false; // Returns false if no matches
        }
    }

    /**
     * Executes the controller method based on the route
     *
     * @return void
     */
    public function execute(): void
    {
        $controller = new $this->controller(); // Creates a new instance of the controller
        $method = $this->method; // Sets the method to be called

        if (isset($this->matches[2])) {
            $controller->$method($this->matches[1], $this->matches[2]); // Calls the method with two parameters if present
        } elseif (isset($this->matches[1])) {
            $controller->$method($this->matches[1]); // Calls the method with one parameter if present
        } else {
            $controller->$method(); // Calls the method with no parameters
        }
    }
}

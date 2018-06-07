<?php

namespace App\Core;

use App\Core\Exception\PageNotFoundException;
use Exception;

class Router
{
    /**
     * Routes methods
     *
     * @var array
     */
    public $routes = [
        'GET'  => [],
        'POST' => []
    ];

    /**
     * Handle GET method
     *
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Handle POST method
     *
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Direct to appropriate controller
     *
     * @param $uri
     * @param $requestType
     * @return mixed
     * @throws Exception
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }
        
        throw new PageNotFoundException('No route defined for this URL', 404);
    }

    /**
     * Call controller method
     *
     * @param $controller
     * @param $action
     * @return mixed
     * @throws Exception
     */
    public function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;
        if (! method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action();
    }
}
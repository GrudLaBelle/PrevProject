<?php

namespace Router;

use App\Exceptions\NotFoundException;

class Router
{

    public $url;
    public $routes = [];

    // constructor
    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    // method GET
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }
    
    // method POST
    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    // method execution of the route if it is referenced
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }

        throw new NotFoundException("La page demandée est introuvable.");
    }
}

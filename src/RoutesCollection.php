<?php

namespace App;

interface RouteCollection
{
    function getRoute(string $route_name);
    function getAll();
    function add(string $name, Route $route);
}

class Route
{
    public $pathname;
    public $controller;
    public $method;
    public $params;

    public function __construct(string $pathname, array $argsc)
    {
        $this->pathname = $pathname;
        $this->controller = $argsc["controller"];
        $this->method = $argsc["method"];
        $this->params = isset($argsc["params"]) ? $argsc["params"] : null;

        return $this;
    }
}

class RoutesCollection implements RouteCollection
{
    public $routes = [];

    public function __construct()
    {
        return $this->routes;
    }

    public function add(string $name, Route $route)
    {
        $this->routes[$name] = $route;
    }

    public function getAll()
    {
        return $this->routes;
    }

    public function getRoute(string $pathname)
    {
        return $this->routes[$pathname];
    }
}

<?php

namespace core;

class Router
{
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function run()
    {
        $parts = explode('/', $this->route);
        $controller = $parts[0];
        $method = $parts[1];
    }
}
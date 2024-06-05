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
        $controller = ucfirst($parts[0]).`Controller `;
        $method = `action`.ucfirst($parts[1]);
        echo $controller;
    }
}
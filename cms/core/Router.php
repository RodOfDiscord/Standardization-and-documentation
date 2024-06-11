<?php

namespace core;

class Router {
    protected $route;
    protected $requestMethod;
    protected $routes = [];

    public function __construct($route, $requestMethod = 'GET') {
        $this->route = $route;
        $this->requestMethod = $requestMethod;
    }

    public function run() {
        if ($this->requestMethod === 'POST') {
            if (isset($this->routes['POST'][$this->route])) {
                $this->execute($this->routes['POST'][$this->route]);
                return;
            }
        } else {
            $parts = explode('/', trim($this->route, '/'));
            if (empty($parts[0])) {
                $parts[0] = "movies";
                $parts[1] = "index";
            }
            if (count($parts) == 1) {
                $parts[1] = 'index';
            }

            \core\Core::get()->moduleName = $parts[0];
            \core\Core::get()->actionName = $parts[1];

            $controller = "controllers\\" . ucfirst($parts[0]) . "Controller";
            $method = "action" . ucfirst($parts[1]);

            if ($parts[0] == "users" && $parts[1] == "profile") {
                $controller = "controllers\\ProfileController";
                $method = "actionIndex";
            } elseif ($parts[0] == "movies") {
                if ($parts[1] == "filter") {
                    $controller = "controllers\\FilterController";
                    $method = "actionFilter";
                } elseif ($parts[1] == "sortByRating") {
                    $controller = "controllers\\FilterController";
                    $method = "actionSortByRating";
                }
            }


            if (class_exists($controller)) {
                $controllerObject = new $controller;
                Core::get()->controllerObject = $controllerObject;

                if (method_exists($controller, $method)) {
                    array_splice($parts, 0, 2);
                    $params = $controllerObject->$method($parts);
                    return $params;
                } else {
                    $this->error(404);
                }
            } else {
                $this->error(404);
            }
        }
    }



    public function error($code) {
        http_response_code($code);
        switch ($code) {
            case 404:
                echo "404 Not Found";
                break;
        }
    }

    public function post($route, $controllerAction) {
        $this->routes['POST'][$route] = $controllerAction;
    }
    public function done() {

    }
    protected function execute($controllerAction) {
        $parts = explode('@', $controllerAction);
        $controller = "controllers\\" . $parts[0];
        $method = "action" . ucfirst($parts[1]);

        if (class_exists($controller)) {
            $controllerObject = new $controller;
            Core::get()->controllerObject = $controllerObject;

            if (method_exists($controller, $method)) {
                $params = $_POST;
                $controllerObject->$method($params);
            } else {
                $this->error(404);
            }
        } else {
            $this->error(404);
        }
    }
}
?>

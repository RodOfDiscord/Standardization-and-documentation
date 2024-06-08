<?php

namespace core;

class View {
    protected $params = [];

    public function setParams($params) {
        $this->params = $params;
    }

    public function display() {
        extract($this->params);
        include $this->getViewFile();
    }

    protected function getViewFile() {
        $controllerName = Core::get()->moduleName;
        $actionName = Core::get()->actionName;
        return "views/{$controllerName}/{$actionName}.php";
    }
}

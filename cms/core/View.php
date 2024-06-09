<?php
namespace core;

class View {
    protected $params = [];

    public function setParams($params) {
        $this->params = $params;
    }

    public function render($viewName, $params = []) {
        $this->setParams($params);
        $this->display($viewName);
    }

    public function display($viewName) {
        extract($this->params);
        include $this->getViewFile($viewName);
    }

    protected function getViewFile($viewName) {
        return "views/{$viewName}.php";
    }
}


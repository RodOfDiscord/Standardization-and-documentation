<?php

namespace core;

class Post extends RequestMethod {
    // Конструктор
    public function __construct() {
        parent::__construct($_POST);
    }

    public function __get($name) {
        return $_POST[$name] ?? null;
    }
}


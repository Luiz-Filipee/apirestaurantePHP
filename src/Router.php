<?php

class Router {
    private $routes = [];

    public function add($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function addPost($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function addPut($path, $callback){
        $this->routes['PUT'][$path] = $callback;
    }

    public function addDelete($path, $callback){
        $this->routes['DELETE'][$path] = $callback;
    }

    public function dispatch($requestedPath) {
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$requestedPath])) {
            return call_user_func($this->routes[$method][$requestedPath]);
        }

        echo "404 - Página não encontrada";
    }
}

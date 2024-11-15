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

        if (!isset($this->routes[$method])) {
            echo "404 - Página não encontrada";
            return;
        }

        foreach ($this->routes[$method] as $path => $callback) {
            $pattern = '#^' . preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^/]+)', $path) . '$#';
            
            if (preg_match($pattern, $requestedPath, $matches)) {
                return call_user_func_array($callback, array_values($matches));
            }
        }

        echo "404 - Página não encontrada";
    }
}

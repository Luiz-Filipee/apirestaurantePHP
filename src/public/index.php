<?php
require_once("restaurantephpapi/app/src/Router.php");

$router = new Router();

$router->add('/', function () {
    echo "Página inicial";
});

$router->add('/mesas', function () {
    echo "Página de mesas";
});

$router->add('/pedidos', function () {
    echo "Página de pedidos";
});

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->dispatch($requestedPath);
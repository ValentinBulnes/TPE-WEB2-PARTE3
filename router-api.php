<?php
require_once './libs/router.php';
require_once './app/api/api-product.controller.php';

// creo el router
$router = new Router();

// defino la tabla de ruteo
$router->addRoute('productos', 'GET', 'ApiProductController', 'getAll');
$router->addRoute('productos/:ID', 'GET', 'ApiProductController', 'get');
$router->addRoute('productos/:ID', 'DELETE', 'ApiProductController', 'delete');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
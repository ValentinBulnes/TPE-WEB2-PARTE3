<?php
require_once './libs/router.php';
require_once './app/controllers/product.api.controller.php';


$router = new Router();


$router->addRoute('productos', 'GET', 'ProductApiController', 'getAll');
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'delete');
$router->addRoute('productos', 'POST', 'ProductApiController', 'create');
$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'updateProduct');
$router->addRoute('ofertas', 'GET', 'ProductApiController', 'getOfertas');
$router->addRoute('ofertas/:ID', 'GET', 'ProductApiController', 'getOfertasPorCategoria');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
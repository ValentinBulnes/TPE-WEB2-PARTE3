<?php
require_once './libs/router.php';
require_once './app/controllers/product.api.controller.php';


// creo el router
$router = new Router();

// defino la tabla de ruteo
//                 endpoint  , verbo ,      controller      ,   metodo
$router->addRoute('productos', 'GET', 'ProductApiController', 'getAll');
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'get');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'delete');
$router->addRoute('productos', 'POST', 'ProductApiController', 'create');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
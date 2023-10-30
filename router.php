<?php
    require_once 'config.php';
    require_once 'libs/router.php';


    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('tareas',     'GET',    'ApiController', 'get'   );
    $router->addRoute('tareas',     'POST',   'ApiController', 'create');
    $router->addRoute('tareas/:ID', 'GET',    'ApiController', 'get'   );
    $router->addRoute('tareas/:ID', 'PUT',    'ApiController', 'update');
    $router->addRoute('tareas/:ID', 'DELETE', 'ApiController', 'delete');
    
    $router->addRoute('tareas/:ID/:subrecurso', 'GET',    'TaskApiController', 'get'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

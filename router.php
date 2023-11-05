<?php
    require_once ('config.php');
    require_once ('libs/router.php');
    require_once ('./app/controller/wineApiController.php');
    require_once ('./app/controller/cellarApiController.php');
    require_once ('./app/controller/userApiController.php');


    $router = new Router();

    #wine             endpoint      verbo    controller           método

    $router->addRoute('wines',     'GET',    'WineApiController', 'getAll'    );
    $router->addRoute('wines',     'POST',   'WineApiController', 'addwine'   );
    $router->addRoute('wines/:ID', 'GET',    'WineApiController', 'getWine'   );
    $router->addRoute('wines/:ID', 'PUT',    'WineApiController', 'upDateWine');
    $router->addRoute('wines/:ID', 'DELETE', 'WineApiController', 'deleteWine');
    

    #cellar           endpoint        verbo     controller             método

    $router->addRoute('cellars',     'GET',    'CellarApiController', 'getAll'      );
    $router->addRoute('cellars',     'POST',   'CellarApiController', 'addCellar'   );
    $router->addRoute('cellars/:ID', 'GET',    'CellarApiController', 'getCellar'   );
    $router->addRoute('cellars/:ID', 'PUT',    'CellarApiController', 'upDateCellar');
    $router->addRoute('cellars/:ID', 'DELETE', 'CellarApiController', 'deleteCellar');

    $router->addRoute('user/token',  'GET',    'UserApiController',   'getToken');

    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

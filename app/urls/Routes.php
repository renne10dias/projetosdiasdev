<?php

namespace app\urls;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Routes{
    public static function defineRoutes(){
        return simpleDispatcher(function (RouteCollector $r) {
            $r->addRoute('GET', '/projetosdiasdev/user/{id:\d+}', ['app\controller\api\ApiController', 'teste2']);
            $r->addRoute('GET', '/fastRouter/user/{id:\d+}', ['app\controller\api\ApiController', 'home']);
        });
    }

    public static function hello($vars)
    {
        echo 'Hello World!';
    }
}
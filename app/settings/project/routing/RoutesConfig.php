<?php

namespace app\settings\project\routing;


use app\urls\Routes;

class RoutesConfig{
    protected $dispatcher;

    public function __construct(){
        $this->dispatcher = Routes::defineRoutes();
    }

    public function dispatch($httpMethod, $uri){
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                echo '404 - Página não encontrada';
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 - Método não permitido';
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                // Instancia o controlador e chama o método apropriado
                $controllerName = $handler[0];
                $method = $handler[1];
                $controller = new $controllerName();
                $controller->$method($vars);
                break;
        }
    }
}
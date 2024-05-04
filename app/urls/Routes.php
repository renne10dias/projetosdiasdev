<?php

namespace app\urls;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Routes
{
    public static function defineRoutes(){
        return simpleDispatcher(function (RouteCollector $r) {
            $r->addGroup('/projetosdiasdev/', function (RouteCollector $r) {
                $r->addRoute('GET', '', ['app\controller\page\site\HomeController', 'home']);
            });

            $r->addGroup('/projetosdiasdev/panel', function (RouteCollector $r) {
                $r->addRoute('GET', '', ['app\controller\page\panel_admin\DashboardController', 'dashboard']);
                $r->addRoute('GET', '/dashboard', ['app\controller\page\panel_admin\DashboardController', 'dashboard']);
                $r->addRoute('GET', '/profile', ['app\controller\page\panel_admin\ProfileController', 'profile']);
                $r->addRoute('GET', '/news', ['app\controller\page\panel_admin\PostNewsController', 'postNews']);
            });

            $r->addGroup('/projetosdiasdev/api', function (RouteCollector $r) {
                $r->addRoute('POST', '/post/news', ['app\controller\api\panel\news\NewsControllerTeste3', 'postNews']);

            });

            $r->addRoute('GET', '/projetosdiasdev/user/{id:\d+}', ['app\controller\api\ApiController', 'teste2']);
            $r->addRoute('GET', '/fastRouter/user/{id:\d+}', ['app\controller\api\ApiController', 'home']);
        });
    }

    public static function hello($vars)
    {
        echo 'Hello World!';
    }
}

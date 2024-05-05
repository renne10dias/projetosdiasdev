<?php

namespace app\urls;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Routes{
    public static function defineRoutes(){
        return simpleDispatcher(function (RouteCollector $r) {
            $baseUrl = '/projetosdiasdev/';

            // SITE ROUTES
            $r->addGroup($baseUrl, function (RouteCollector $r) { // projetosdiasdev/
                $r->addRoute('GET', '', ['app\controller\page\site\HomeController', 'home']);
            });

            // PANEL ROUTES
            $r->addGroup($baseUrl. 'panel', function (RouteCollector $r) { // panel/dashboard
                $r->addRoute('GET', '', ['app\controller\page\panel_admin\DashboardController', 'dashboard']);
                $r->addRoute('GET', '/dashboard', ['app\controller\page\panel_admin\DashboardController', 'dashboard']);
                $r->addRoute('GET', '/profile', ['app\controller\page\panel_admin\ProfileController', 'profile']);
                $r->addRoute('GET', '/news', ['app\controller\page\panel_admin\PostNewsController', 'postNews']);
            });

            // API ROUTES
            $r->addGroup($baseUrl. 'api', function (RouteCollector $r) {  // api/post/news
                $r->addRoute('POST', '/post/news', ['app\controller\api\panel\news\NewsController', 'postNews']);

            });

            $r->addRoute('GET', '/projetosdiasdev/user/{id:\d+}', ['app\controller\api\ApiController', 'teste2']);
            $r->addRoute('GET', '/fastRouter/user/{id:\d+}', ['app\controller\api\ApiController', 'home']);
        });
    }

}

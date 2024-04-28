<?php

namespace app\urls;

use app\settings\project\routing\Routes;

class RouteManagement{

    public static function setupRoutes(): Routes{
        $baseUrl = '/projetosdiasdev'; // Variável para a parte fixa da URL

        $routes = new Routes();

        // PAGES WEB SITE
        $routes->addRoute($baseUrl, 'app\controller\page\site\HomeController', 'home', 'GET');

        // PAGES WEB PANEL
        $routes->addRoute($baseUrl . '/panel', 'app\controller\page\panel_admin\HomeController', 'home', 'GET');
        $routes->addRoute($baseUrl . '/panel/dashboard', 'app\controller\page\panel_admin\DashboardController', 'dashboard', 'GET');
        $routes->addRoute($baseUrl . '/panel/profile', 'app\controller\page\panel_admin\ProfileController', 'profile', 'GET');

        // API WEB
        // PANEL
        $routes->addRoute($baseUrl . '/api/post/news', 'app\controller\api\panel\news\NewsController', 'postNews', 'POST');

        $routes->addRoute($baseUrl . '/api/home', 'app\controller\api\ApiController', 'home', 'GET');
        $routes->addRoute($baseUrl . '/api/teste', 'app\controller\api\ApiController', 'login', 'GET');
        $routes->addRoute($baseUrl . '/api/teste1', 'app\controller\api\ApiController', 'teste1', 'POST');
        $routes->addRoute($baseUrl . '/api/teste2/{userId}', 'app\controller\api\ApiController', 'teste2', 'PUT');
        $routes->addRoute($baseUrl . '/api/teste3/delete/{userId}', 'app\controller\api\ApiController', 'teste3', 'DELETE');

        return $routes;
    }

}

<?php

namespace public;


use app\domain\service\website_visits\CountVisitsService;
use app\urls\RouteManagement;

require_once __DIR__ . '/../vendor/autoload.php';



$routes = RouteManagement::setupRoutes();
$routes->handleRequest();
CountVisitsService::getVisits();





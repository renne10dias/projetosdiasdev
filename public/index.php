<?php

namespace public;


use app\domain\service\website_visits\CountVisitsService;
use app\settings\project\routing\RoutesConfig;

require_once __DIR__ . '/../vendor/autoload.php';



$config = new RoutesConfig();

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if ($httpMethod === 'OPTIONS') {
    // Responda com cabeçalhos CORS apropriados
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 86400");
    exit(0);
}

$config->dispatch($httpMethod, $uri);
CountVisitsService::getVisits();





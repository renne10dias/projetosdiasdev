<?php

namespace app\controller\page\panel_admin;

use app\settings\project\http\HttpStatus;
use app\settings\project\renderHtml\LoadHtmlPage;

class DashboardController{

    public function dashboard(){
        try {
            $htmlLoader = new LoadHtmlPage();
            $htmlFilePath = '/../../../../public/web/panel/html/index.html';
            $htmlLoader->loadUserHtmlPage($htmlFilePath);
        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }
}
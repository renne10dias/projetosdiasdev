<?php

namespace app\controller\page\site;

use app\settings\project\http\HttpStatus;
use app\settings\project\renderHtml\LoadHtmlPage;

class HomeController{

    public function home(){
        try {
            $htmlLoader = new LoadHtmlPage();
            $htmlFilePath = '/../../../../public/web/Site/index.html';
            $htmlLoader->loadUserHtmlPage($htmlFilePath);
        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }


}
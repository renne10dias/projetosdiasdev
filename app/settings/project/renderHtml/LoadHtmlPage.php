<?php

namespace app\settings\project\renderHtml;

class LoadHtmlPage{

    public function loadUserHtmlPage($htmlFilePath){

        $htmlFilePathSystem = __DIR__ . $htmlFilePath;

        if (file_exists($htmlFilePathSystem)) {
            $htmlContent = file_get_contents($htmlFilePathSystem);
            header('Content-Type: text/html');
            echo $htmlContent;
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Arquivo HTML não encontrado"]);
        }
    }


}


// Crie uma instância da classe LoadHtmlPage
// $htmlLoader = new LoadHtmlPage();

// Especifique o caminho do arquivo HTML a ser carregado
// $htmlFilePath = '/caminho/para/seu/arquivo.html';

// Chame o método loadUserHtmlPage com o caminho do arquivo HTML como argumento
// $htmlLoader->loadUserHtmlPage($htmlFilePath);
<?php

namespace app\controller\api\panel\news;

use app\domain\entity\news\News;
use app\domain\service\panel\news\NewsService;
use app\settings\project\http\HttpStatus;
use app\settings\project\message\BusinessMessage;
header('Content-Type: application/json');

class NewsControllerTeste3{

    public function postNews() {
        try {

            // Extrair os outros dados da notícia do corpo da requisição
            $data = json_decode(file_get_contents("php://input"), true);

            // Verifique se os dados foram decodificados corretamente
            if ($data === null) {
                new BusinessMessage('Falha na decodificação do JSON.', 400);
            }


            $title = $data['title'];
            $description = $data['description'];
            $text = $data['text'];
            $imagesArray = $data['images'];
            $type = $data['type'];
            $tb_category_uuid = $data['tb_category_uuid'];
            $tb_user_uuid = $data['tb_user_uuid'];


            // Criar uma nova instância de News com os dados da requisição
            $news = new News($title, $description, $text, $imagesArray, $type, $tb_category_uuid, $tb_user_uuid,);
            // Salvar a notícia
            $newsService = new NewsService();
            $newsService->postNews($news);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para postar uma noticia
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

}
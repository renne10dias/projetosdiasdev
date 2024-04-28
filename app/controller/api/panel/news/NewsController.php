<?php

namespace app\controller\api\panel\news;

use app\domain\entity\news\News;
use app\domain\service\panel\news\NewsService;
use app\settings\project\http\HttpStatus;
use app\settings\project\message\BusinessMessage;
header('Content-Type: application/json');

class NewsController{

    public function postNews(){
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            // Verifique se a decodificação do JSON foi bem-sucedida
            if ($data === null) {
                echo json_encode(array('message' => 'Falha na decodificação do JSON.'));
                new HttpStatus(400);
                exit;
            }
            // Verifique se os campos obrigatórios estão presentes
            if (!isset($data['title']) || !isset($data['description']) || !isset($data['text']) ||
                !isset($data['tb_category_uuid']) || !isset($data['tb_user_uuid'])) {
                echo json_encode(array('message' => 'Campos obrigatórios não podem estar vazios.'));
                new HttpStatus(400);
                exit;
            }

            // NEWS
            $title = $data['title'];
            $description = $data['description'];
            $text = $data['text'];
            // CATEGORY
            $tb_category_uuid = $data['tb_category_uuid'];
            // USER
            $tb_user_uuid = $data['tb_user_uuid'];

            $news = new News($title, $description, $text, $tb_category_uuid, $tb_user_uuid);
            $postNews = new NewsService();
            // Registrar o cliente usando o serviço de registro
            $postNews->postNews($news);



            new BusinessMessage('Mensagem da classe ApiController login', 200);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

}
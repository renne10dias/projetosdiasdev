<?php

namespace app\controller\api\panel\news;

use app\domain\entity\news\News;
use app\domain\service\panel\news\NewsService;
use app\settings\project\http\HttpStatus;
use app\settings\project\message\BusinessMessage;
header('Content-Type: application/json');

class NewsControllerTeste2{


    public function postNews() {
        try {




            // Extrair os outros dados da notícia do corpo da requisição
            $data = json_decode(file_get_contents("php://input"), true);

            // Verifique se os dados foram decodificados corretamente
            if ($data === null) {
                new BusinessMessage('Falha na decodificação do JSON.', 400);
            }


            $image = [
                'base64' => $data['image']['base64'], // Substitua isso pela sua string base64 válida
                'fileName' => $data['image']['name'] // Substitua isso pelo nome do arquivo da imagem
            ];

            // Criar uma nova instância de News com os dados da requisição
            $news = new News(
                $data['title'],
                $data['description'],
                $data['text'],
                $image, // Passa os dados da imagem diretamente para o construtor da News
                $data['type'],
                $data['tb_category_uuid'],
                $data['tb_user_uuid']
            );

            // Salvar a notícia
            $newsService = new NewsService();
            $newsService->postNews($news);

        } catch (\Exception $e) {
            // Tratamento de erro específico para postar uma noticia
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }






}
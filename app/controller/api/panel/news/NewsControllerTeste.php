<?php

namespace app\controller\api\panel\news;

use app\domain\entity\news\News;
use app\domain\service\panel\news\NewsService;
use app\settings\project\http\HttpStatus;
use app\settings\project\message\BusinessMessage;
header('Content-Type: application/json');

class NewsControllerTeste{


    public function postNews() {
        try {
            // Verifique se os dados da imagem foram enviados corretamente
            if (!isset($_FILES['image'])) {
                new BusinessMessage('Imagem não enviada.!', 400);
            }

            // Extrair os dados da imagem da requisição
            $image = $_FILES['image'];

            /*
            // Extrair os outros dados da notícia do corpo da requisição
            $data = json_decode(file_get_contents("php://input"), true);

            // Verifique se os dados foram decodificados corretamente
            if ($data === null) {
                new BusinessMessage('Falha na decodificação do JSON.', 400);
            }

            // Verifique se todos os campos obrigatórios estão presentes
            $requiredFields = ['title', 'description', 'text', 'type', 'tb_category_uuid', 'tb_user_uuid'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    new BusinessMessage("Campo obrigatório '$field' não pode estar vazio.", 400);
                }
            }

            */

            // Criar uma nova instância de News com os dados da requisição
            $news = new News(
                $_POST['title'],
                $_POST['description'],
                $_POST['text'],
                $_FILES['image'], // Passa os dados da imagem diretamente para o construtor da News
                $_POST['type'],
                $_POST['tb_category_uuid'],
                $_POST['tb_user_uuid']
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
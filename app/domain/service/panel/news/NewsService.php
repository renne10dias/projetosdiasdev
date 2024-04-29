<?php

namespace app\domain\service\panel\news;

use app\domain\entity\news\Category;
use app\domain\entity\news\News;
use app\settings\project\database\Database;
use app\settings\project\message\BusinessMessage;

class NewsService{

    public function postNews(News $news): void{
        try {
            // Obtém a instância da conexão
            $db = Database::getInstance();
            // Obtém a conexão PDO
            $connection = $db->getConnection();
            // Inicia a transação
            $connection->beginTransaction();

            // NEWS
            $uuid = $news->getUuid();
            $title = $news->getTitle();
            $description = $news->getDescription();
            $text = $news->getText();
            $slug = $news->getSlug();
            $link_share_news = $news->getLinkShareNews();
            $type = $news->getType();
            $created_at = $news->getCreatedAt();
            $tb_category_uuid = $news->getTbCategoryUuid();
            $tb_user_uuid = $news->getTbUserUuid();


            // Etapa 2: Inserir detalhes do cliente na tabela tb_client_details
            $stmt_details = $connection->prepare("INSERT INTO tb_news (uuid, title, description, text, slug, link_share_news, type, created_at, tb_category_uuid, tb_user_uuid) VALUES (:uuid, :title, :description, :text, :slug, :link_share_news, :type, :created_at, :tb_category_uuid, :tb_user_uuid)");
            $stmt_details->bindParam(':uuid', $uuid, \PDO::PARAM_STR);
            $stmt_details->bindParam(':title', $title, \PDO::PARAM_STR);
            $stmt_details->bindParam(':description', $description, \PDO::PARAM_STR);
            $stmt_details->bindParam(':text', $text, \PDO::PARAM_STR);
            $stmt_details->bindParam(':slug', $slug, \PDO::PARAM_STR);
            $stmt_details->bindParam(':link_share_news', $link_share_news, \PDO::PARAM_STR);
            $stmt_details->bindParam(':type', $type, \PDO::PARAM_STR);
            $stmt_details->bindParam(':created_at', $created_at, \PDO::PARAM_STR);
            $stmt_details->bindParam(':tb_category_uuid', $tb_category_uuid, \PDO::PARAM_STR);
            $stmt_details->bindParam(':tb_user_uuid', $tb_user_uuid, \PDO::PARAM_STR);
            $stmt_details->execute();


            // Confirmar a transação
            $connection->commit();
            new BusinessMessage('Noticia postada com sucesso!', 201);

        } catch (\PDOException $e) {
            echo "Erro no NewsService: " . $e->getMessage();
        }
    }

}
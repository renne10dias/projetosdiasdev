<?php

namespace app\domain\service\website_visits;

use app\domain\entity\website_visits\Visits;
use app\settings\project\database\Database;

class CountVisitsService{

    public static function getVisits(): void{
        $navegador = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $dados = new Visits($navegador, $ip);
        self::salveVisits($dados);
    }

    public static function salveVisits(Visits $visits): void{
        try {
            // Obtém a instância da conexão
            $db = Database::getInstance();
            // Obtém a conexão PDO
            $connection = $db->getConnection();
            // Inicia a transação
            $connection->beginTransaction();

            $uuid = $visits->getUuid();
            $date = $visits->getDate();
            $browser = $visits->getBrowser();
            $ip = $visits->getIp();

            // Etapa 2: Inserir detalhes do cliente na tabela tb_client_details
            $stmt_details = $connection->prepare("INSERT INTO tb_visits_web (uuid, date, browser, ip) VALUES (:uuid, :date, :browser, :ip)");
            $stmt_details->bindParam(':uuid', $uuid, \PDO::PARAM_STR);
            $stmt_details->bindParam(':date', $date, \PDO::PARAM_STR);
            $stmt_details->bindParam(':browser', $browser, \PDO::PARAM_STR);
            $stmt_details->bindParam(':ip', $ip, \PDO::PARAM_STR);
            $stmt_details->execute();

            // Confirmar a transação
            $connection->commit();

        } catch (\PDOException $e) {
            echo "Erro no CountVisitsService: " . $e->getMessage();
        }
    }
}
<?php

namespace app\settings\project\database;

use app\settings\project\message\BusinessMessage;

class Database{
    protected $connection;
    private static $instance;

    private const HOST = 'localhost';
    private const DATABASE = 'cmacad24_projetosdiasdev';
    private const USERNAME = 'root';
    private const PASSWORD = '*';

    private function __construct(){
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DATABASE;
        try {
            $this->connection = new \PDO($dsn, self::USERNAME, self::PASSWORD);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            //throw new \RuntimeException('Error connecting to the database or Database unavailable');
            //throw new \RuntimeException('Erro na conexão com o banco de dados: ' . $e->getMessage());
            //throw new BusinessException('Error connecting to the database or Database unavailable', 500);
            new BusinessMessage('Error connecting to the database or Database unavailable', 500);
        }
    }

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

    public function __destruct(){
        // Fechar a conexão quando o objeto é destruído
        $this->connection = null;
    }

}
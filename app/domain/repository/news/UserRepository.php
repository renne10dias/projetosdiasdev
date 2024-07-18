<?php

namespace app\domain\repository\news;

use app\settings\project\database\Database;

class UserRepository implements UserRepositoryInterface{
    protected $pdo;

    public function __construct(){
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function all(){
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data){
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->execute(['name' => $data['name'], 'email' => $data['email']]);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e; // Re-throw the exception to handle it at a higher level
        }
    }

    public function update($id, array $data){
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $stmt->execute(['name' => $data['name'], 'email' => $data['email'], 'id' => $id]);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e; // Re-throw the exception to handle it at a higher level
        }
    }

    public function delete($id){
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e; // Re-throw the exception to handle it at a higher level
        }
    }
}
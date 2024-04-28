<?php

namespace app\controller\api;
use app\settings\project\http\HttpStatus;
use app\settings\project\message\BusinessMessage;

class ApiController{

    public function home(){
        try {
            new BusinessMessage('Mensagem da classe ApiController home', 200);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

    public function login(){
        try {

            new BusinessMessage('Mensagem da classe ApiController login', 200);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

    public function teste1(){
        try {

            new BusinessMessage('Teste 1', 200);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

    public function teste2($userId){
        try {
            // Monta a mensagem JSON diretamente e retorna
            new BusinessMessage("Teste 2 com ApiController ID $userId", 200);
        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            new HttpStatus(500);
            return json_encode(["message controller: " => $e->getMessage()]);
        }
    }



    public function teste3($userId){
        try {

            new BusinessMessage("Teste 3 com ApiController ID $userId", 201);

        } catch (\RuntimeException $e) {
            // Tratamento de erro específico para falha na busca de clientes
            //$this->httpCode = 500;
            new HttpStatus(500);
            echo json_encode(["message controller: " => $e->getMessage()]);
        }
    }

}
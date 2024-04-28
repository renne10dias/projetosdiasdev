<?php

namespace app\settings\project\message;

use Exception;

class BusinessException extends Exception{


    public function __construct($message, $code){
        parent::__construct($message, $code);
    }

    public function sendHttpResponse(){
        http_response_code($this->getCode());
        echo json_encode(['message' => $this->getMessage()]);
        exit; // Termina a execução do script após enviar a resposta
    }
}
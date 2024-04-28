<?php

namespace app\settings\project\message;

class BusinessMessage {

    protected $message;
    protected $code;

    public function __construct($message, $code) {
        $this->message = $message;
        $this->code = $code;
        $this->sendHttpResponse();
    }

    protected function sendHttpResponse() {
        http_response_code($this->code);
        echo json_encode(['message' => $this->message]);
        exit; // Termina a execução do script após enviar a resposta
    }
}

// Exemplo de uso
//new BusinessMessage('Mensagem de erro', 401);
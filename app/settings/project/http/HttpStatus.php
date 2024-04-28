<?php

namespace app\settings\project\http;

class HttpStatus{

    protected $code;

    public function __construct($code) {
        $this->code = $code;
        $this->sendHttpResponse();
    }

    protected function sendHttpResponse() {
        http_response_code($this->code);
        exit; // Termina a execução do script após enviar a resposta
    }

}

// Exemplo de uso
//new HttpStatus(401);
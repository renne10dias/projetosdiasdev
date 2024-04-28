<?php

namespace app\settings\libraries\uuid;

use Ramsey\Uuid\Uuid;

class UUIDGenerator {
    private $uuid;

    public function __construct() {
        // Gera um UUID usando Ramsey UUID
        $this->uuid = Uuid::uuid4()->toString();
    }

    public function getUUID() {
        return $this->uuid;
    }
}

// Exemplo de uso:

// Cria uma instância da classe UUIDGenerator
//$uuidGenerator = new UUIDGenerator();
// Obtém o UUID gerado
//$uuid = $uuidGenerator->getUUID();
// Exibe o UUID gerado
//echo "UUID gerado: $uuid";

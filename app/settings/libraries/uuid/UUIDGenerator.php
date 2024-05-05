<?php

namespace app\settings\libraries\uuid;

use Ramsey\Uuid\Uuid;

class UUIDGenerator {
    public static function getUUID() {
        // Gera um UUID usando Ramsey UUID
        return Uuid::uuid4()->toString();
    }
}

// Exemplo de uso:

// Obtém o UUID gerado
//$uuid = UUIDGenerator::getUUID();
// Exibe o UUID gerado
//echo "UUID gerado: $uuid";

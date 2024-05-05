<?php

namespace app\domain\utils;

use app\settings\project\message\BusinessMessage;

class Validation {



    public static function validateUUID(string $uuid): string {
        try {
            // Regex para validar um UUID no formato 8-4-4-4-12
            $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

            // Verifica se o UUID corresponde ao formato esperado
            if (!preg_match($regex, $uuid) == 1) {
                new BusinessMessage('The UUID is invalid.', 400);
            }
            return $uuid;
        } catch (\InvalidArgumentException $e) {
            // Captura a exceção e retorna a mensagem de erro
            return $e->getMessage();
        }
    }

    public static function validateTypeNews(string $type): string{
        if (!($type === 'lazer' || $type === 'tecnologia' || $type === 'cursos')) {
            new BusinessMessage('The system does not accept this type of category.', 400);
        }
        return $type;
    }



}

// Exemplo de uso:
//$uuid = '550e8400-e29b-41d4-a716-446655440000';
//if (validarUUID($uuid)) {
    //echo "O UUID é válido.";
//} else {
    //echo "O UUID é inválido.";
//}
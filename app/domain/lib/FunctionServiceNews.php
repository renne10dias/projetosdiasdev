<?php

namespace app\domain\lib;

class FunctionServiceNews{

    public static function slugify($title) {
        // Converte o título para minúsculas
        $slug = strtolower($title);
        // Substitui caracteres especiais por espaços em branco
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        // Substitui espaços por hífens
        $slug = str_replace(' ', '-', $slug);
        // Remove múltiplos hífens consecutivos
        $slug = preg_replace('/-+/', '-', $slug);
        // Remove hífens no início e no fim
        $slug = trim($slug, '-');

        return $slug;
    }

}

// Exemplo de uso:
//$titulo = "Como criar uma função em PHP";
//$slug = FunctionServiceNews::slugify($titulo);
//echo $slug; // Saída: como-criar-uma-funcao-em-php

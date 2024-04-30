<?php

namespace app\domain\utils;

class FileUploader {

    public function uploadImage(array $image): string {
        if($image['error'])
            die("Failed to upload file");

        if($image['size'] > 2097152) // larger than 2 MB
            die("File too large!! Max: 2 MB");

        $folder = __DIR__ . "/../../files/images/";
        $fileName = $image['name'];
        $newFileName = uniqid(); // generate a unique id.
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Handle the file type you are going to upload
        // This way you prevent a user from sending a malicious file.
        if($extension != "jpg" && $extension != 'png')
            die("File type not accepted");

        $path = $folder . $newFileName . "." . $extension;

        $success = move_uploaded_file($image["tmp_name"], $path);
        if($success){
            return $path; // Retorna o caminho da imagem
        } else {
            die("Failed to upload image");
        }
    }


    public function uploadImageBase64(array $imageData): string {
        // Verifica se todos os parâmetros necessários estão presentes no array
        if (!isset($imageData['base64']) || !isset($imageData['fileName'])) {
            die("Parâmetros base64 e fileName são obrigatórios");
        }

        // Obtém os dados da imagem e o nome do arquivo do array
        $base64Image = $imageData['base64'];
        $fileName = $imageData['fileName'];

        // Decodifica a string base64 para obter os dados binários da imagem
        $imageData = base64_decode($base64Image);

        // Verifica se a decodificação foi bem-sucedida
        if ($imageData === false) {
            die("Erro ao decodificar imagem base64");
        }

        // Escolhe um diretório para salvar a imagem
        $folder = __DIR__ . "/../../files/images/";

        // Gera um nome de arquivo único
        $newFileName = uniqid();

        // Extrai a extensão do nome do arquivo fornecido
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Caminho para salvar a imagem
        $path = $folder . $newFileName . "." . $extension;

        // Salva a imagem no disco
        $success = file_put_contents($path, $imageData);

        // Verifica se a imagem foi salva com sucesso
        if ($success !== false) {
            return $path; // Retorna o caminho da imagem
        } else {
            die("Falha ao fazer upload da imagem");
        }
    }

}

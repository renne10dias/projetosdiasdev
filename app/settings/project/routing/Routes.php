<?php

namespace app\settings\project\routing;

class Routes{

    private $routes = [];

    public function addRoute($uri, $controller, $method = 'index', $httpMethod = 'GET'): void{
        // Validar URI para evitar injeção de código
        $uri = '/' . trim(strip_tags($uri), '/');

        // Substituir parâmetros dinâmicos na URI com expressões regulares
        $uri = preg_replace('/{(\w+)}/', '(?<$1>[^\/]+)', $uri);

        // Verificar se o controlador e método existem
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException("O controlador '$controller' não foi encontrado.");
        }

        if (!method_exists($controller, $method)) {
            throw new \InvalidArgumentException("O método '$method' não existe no controlador '$controller'.");
        }

        // Validar e converter o método HTTP para maiúsculas
        $httpMethod = strtoupper($httpMethod);

        $this->routes[$httpMethod][$uri] = ['controller' => $controller, 'method' => $method];
    }


    public function handleRequest(): void{
        // Adicionar verificação de CORS
        $this->handleCors();

        $requestData = $this->getRequestDataFormatted();
        $method = $requestData['method'];
        $uriParts = $requestData['params'];

        $uri = '/' . implode('/', $uriParts);

        foreach ($this->routes[$method] as $route => $callback) {
            // Verificar se a URI corresponde a um padrão de rota
            if (preg_match("#^$route$#", $uri, $matches)) {
                // Extraindo parâmetros dinâmicos da URI
                $params = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));

                // Combinando a callback com os parâmetros
                $callback['params'] = $params;

                // Executar a callback
                $this->executeCallback($callback);
                return;
            }
        }

        // Rota não encontrada
        http_response_code(404);
        echo json_encode(array("message" => "Rota não encontrada"));
    }

    private function handleCors(): void {
        // Permitir solicitações de qualquer origem
        header("Access-Control-Allow-Origin: *");
        // Permitir métodos específicos
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        // Permitir cabeçalhos específicos
        header("Access-Control-Allow-Headers: Content-Type");
    }


    private function executeCallback($callback): void {
        $controllerName = $callback['controller'];
        $methodName = $callback['method'];

        // Verificar se o nome do controlador e método são válidos
        if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
            // Instanciar o controlador e chamar o método
            $controller = new $controllerName();
            $response = $controller->$methodName(...array_values($callback['params']));

            // Escapar a saída antes de enviar para o navegador
            //$response = htmlspecialchars($response, ENT_QUOTES, 'UTF-8');

            // Você pode retornar a resposta como JSON, por exemplo
            echo $response;
        } else {
            // Controlador ou método não encontrado
            http_response_code(404);
            echo json_encode(array("message" => "Controlador ou método não encontrado"));
        }
    }

    private function getRequestDataFormatted(): array{
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        // Divide a URI em partes usando a barra como delimitador
        $uriParts = explode('/', $uri);

        // Remove segmentos vazios
        $uriParts = array_filter($uriParts);

        // Sanitizar os segmentos da URI
        foreach ($uriParts as &$part) {
            $part = filter_var($part, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        // Monta os parâmetros da requisição em um array
        return [
            'method' => $method,
            'params' => $uriParts
        ];
    }



}
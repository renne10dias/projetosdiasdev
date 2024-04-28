<?php

namespace app\settings\libraries\webSocket\configWebSocket;

use app\settings\libraries\webSocket\chat_users\TestChat;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require_once __DIR__ . '/../../../../../vendor/autoload.php';

class WebSocketServer {
    public static function run() {
        $port = 8081;

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new TestChat()
                )
            ),
            $port
        );

        // Obtém o endereço IP do servidor
        $serverIp = gethostbyname(gethostname());

        echo "WebSocket chat server is running on ws://{$serverIp}:{$port}\n";
        $server->run();
    }
}

// Para iniciar o servidor WebSocket, você pode simplesmente chamar o método run() desta classe:
WebSocketServer::run();
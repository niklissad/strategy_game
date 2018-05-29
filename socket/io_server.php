<?php

require_once __DIR__ . '/../vendor/autoload.php';

exec('kill -9 $(lsof -t -i:8080)');


use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Socket\Behavioral\HandlerMediator;

$ws = new WsServer(new \Socket\GameHandler(new HandlerMediator()));
$server = IoServer::factory(new HttpServer($ws), 8080);
$server->run();
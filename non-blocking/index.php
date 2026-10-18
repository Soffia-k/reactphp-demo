<?php
require __DIR__ . '/vendor/autoload.php';

use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;
use React\EventLoop\Loop;

$server = new HttpServer(function ($request) {
    return new React\Promise\Promise(function ($resolve) {
        Loop::addTimer(2.0, function () use ($resolve) {
            $resolve(Response::plaintext("OK (non-blocking)\n"));
        });
    });
});

$socket = new SocketServer('127.0.0.1:8082');
$server->listen($socket);
echo "ReactPHP server on http://127.0.0.1:8082\n";

//composer require react/http react/socket react/promise
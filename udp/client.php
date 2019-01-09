<?php
/**
 * Created by PhpStorm.
 * User: guruiqin
 * Date: 2018/12/17
 * Time: 4:21 PM
 */

$client = new swoole_client( SWOOLE_UDP,SWOOLE_SOCK_ASYNC);

$client->on("connect", function($cli) {

    $mes = [
        'name' => 'guruiqin',
        'age'  => 20
    ];

    $mes = json_encode($mes);
    $cli->send($mes);
});
$client->on("receive", function($cli, $data){
    echo "received: {$data}\n";
});
$client->on("error", function($cli){
    echo "connect failed\n";
});
$client->on("close", function($cli){
    echo "connection close\n";
});
$client->connect("127.0.0.1", 9502, 0.5);
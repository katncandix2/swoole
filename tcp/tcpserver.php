<?php
    
    $server = new swoole_server("127.0.0.1", 9501);

    $table = new swoole_table(2);
    $table->column('fd',swoole_table::TYPE_INT);
    $table->column('mes',swoole_table::TYPE_STRING,128);
    $table->create();


    $server->set(
        [
            'worker_num' => 4,

            //守护进程
//            'daemonize' => true,
            'backlog' => 128
        ]
    );

    $server->on('connect', function ($server, $fd){
        echo "connection open: {$fd}\n";
    });
    $server->on('receive', function ($curServer, $fd, $reactor_id, $data) use ($table) {

        echo 'fd:'.$fd.PHP_EOL;
        echo 'reactor_id:'.$reactor_id.PHP_EOL;
        echo 'data:'. $data;

        $table->set($fd,[
            'fd' =>  $fd,
            'mes' => $data
        ]);

        $count = $table->count()+1;

        for($i = 1;$i<$count;$i++){

            $res = $table->get($i);

            //多次发送
            $curServer->send($res['fd'],$data);
        }


    });


    $server->on('close', function ($server, $fd) {

        echo "connection close: {$fd}\n";
    });
    $server->start();
<?php
    $timer = swoole_timer_tick(1000,function (){
        echo 'hello';

        swoole_timer_after(2000,function (){
            echo 'after';
        });
    });

    $timer1 = swoole_timer_tick(100,function (){});
    var_dump($timer);

    var_dump($timer1);
    swoole_timer_clear($timer);
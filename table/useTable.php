<?php
    $table = new swoole_table(1024);
    $table->column('id',swoole_table::TYPE_INT,4);
    $table->column('name',swoole_table::TYPE_STRING,10);
    $table->column('num',swoole_table::TYPE_FLOAT);

    $table->create();

    $table->set('user',[
        'id'    =>   1,
        'name'  =>  'guruiqin',
        'num'   =>  1231244,
    ]);

    $table->set('user1',[
        'id'    =>   1,
        'name'  =>  'guruiqin',
        'num'   =>  1231244,
    ]);


    $count = $table->count();


//    $res = $table->get('user');
//    echo $table->count();
//    var_dump($res);
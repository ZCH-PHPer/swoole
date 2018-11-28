<?php

use Swoole\Coroutine as co;

$callback = function($result){
    
};


co::create(function () {
    $db = new Co\MySQL();
    $server = array(
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '1',
        'database' => 'beauty_table',
    );

    $db->connect($server);

    $result = $db->query('SELECT * FROM cdb_beauty_handle_logs limit 2');
    echo '========================';
    //var_dump($result);
    

    $db->recv();
    
    co::sleep(2);
    
});



echo '-------------------------------------------';

var_dump($result);


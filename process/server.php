<?php

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9502 , SWOOLE_BASE, SWOOLE_SOCK_TCP ); 

//$port = $serv->listen("127.0.0.1", 9502 , SWOOLE_BASE);
//echo 'new port：' . $port->port  . "\n";

$serv->set(array(
    'worker_num' => 2,
    'backlog' => 128,
    'heartbeat_check_interval' => 10 ,
    'heartbeat_idle_time' => 20 
));


//监听连接进入事件
$serv->on('connect', function ($serv, $fd) {  

	if( $fd == 1 )
    echo "Client: Connect.\n ({$fd})";
	
	else 
	echo "其他 Client: Connect.\n ({$fd})";	

});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: ".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});


echo '主进程：' . $serv->master_pid . "\n";
echo '管理进程：' . $serv->manager_pid. "\n";
//echo '所有端口：' . json_encode($serv->prots). "\n";


//启动服务器
$serv->start(); 

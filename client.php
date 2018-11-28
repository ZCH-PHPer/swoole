<?php


// $client = new swoole_client(SWOOLE_SOCK_TCP);
// if (!$client->connect('127.0.0.1', 9501, -1))
// {
//     exit("connect failed. Error: {$client->errCode}\n");
// }
// $client->send("hello world\n");
// echo $client->recv();
// $client->close();
// 


$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function(swoole_client $cli) {
	//var_dump($cli->getsockname());
    $cli->send("GET / HTTP/1.1\r\n\r\n");
});
$client->on("receive", function(swoole_client $cli, $data){
	$sock = fopen("php://fd/".$cli->sock , 'r'); 
	var_dump($sock);
	//睡眠模式，不再接收新的数据
    $cli->sleep();
    swoole_timer_after(5000, function() use ($cli) {
    //唤醒，重新接收数据
    	$cli->wakeup();
    });
    // echo "Receive: $data";
    // $cli->send(str_repeat('A', 100)."\n");
    //sleep(1);
});
$client->on("error", function(swoole_client $cli){
    echo "error\n";
});
$client->on("close", function(swoole_client $cli){
    echo "Connection close\n";
});
$client->connect('127.0.0.1', 9502);


// $client = new swoole_client(SWOOLE_SOCK_TCP , SWOOLE_KEEP);
// $client->connect('127.0.0.1', 9501);
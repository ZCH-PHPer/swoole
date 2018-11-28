<?php
$http = new swoole_http_server("127.0.0.1", 9501);

$http->on("request", function ($request, $response) {
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    $client->connect("127.0.0.1", 9502, 0.5);
    //调用connect将触发协程切换
    $client->send("hello world from swoole");
    //调用recv将触发协程切换
    $ret = $client->recv();
    $response->header("Content-Type", "text/plain");
    $response->end($ret);
    $client->close();
});

$http->start();


// go(function () {
//     co::sleep(2.5);
//     echo "hello";
// });

// go("test");
// go([$object, "method"]);



echo Swoole\Coroutine::getuid();
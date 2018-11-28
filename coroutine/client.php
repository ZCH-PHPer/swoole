<?php

// https://github.com/swlib/saber

// client
// go(function(){

// 	$client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
// 	if (!$client->connect('127.0.0.1', 9502, 0.5)){
// 	    exit("connect failed. Error: {$client->errCode}\n");
// 	}
// 	$client->send("hello world\n");
// 	echo $client->recv();
// 	$client->close();

// });


// http\client
// go(function(){
// 	$cli = new Swoole\Coroutine\Http\Client('127.0.0.1', 9501);
// 	$cli->setHeaders([
// 	    'Host' => "192.168.82.31",
// 	    "User-Agent" => 'Chrome/192.168.82.31',
// 	    'Accept' => 'text/html,application/xhtml+xml,application/xml',
// 	    'Accept-Encoding' => 'gzip',
// 	]);
// 	$cli->set([ 'timeout' => 1]);
// 	$cli->get('/index.php');
// 	echo $cli->body;
// 	$cli->close();
// });
// 
// 


// http2\client
go(function () {
    $domain = 'www.zhihu.com';
    $cli = new Swoole\Coroutine\Http2\Client($domain, 443, true);
    $cli->set([
        'timeout' => -1,
        'ssl_host_name' => $domain
    ]);
    $cli->connect();
    $req = new swoole_http2_request;
    $req->method = 'POST';
    $req->path = '/api/v4/answers/300000000/voters';
    $req->headers = [
        'host' => $domain,
        "user-agent" => 'Chrome/49.0.2587.3',
        'accept' => 'text/html,application/xhtml+xml,application/xml',
        'accept-encoding' => 'gzip'
    ];
    $req->data = '{"type":"up"}';
    $cli->send($req);
    $response = $cli->recv();
    assert(json_decode($response->data)->error->code === 602);
});

var_dump(123);


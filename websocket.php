<?php


$userFdList = [];

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) use (&$userFdList) {

	$userFdList[$request->get['uid']] = $request->fd ;
	//var_dump($request);
    //var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "系统：hello, welcome\n");
    // echo '所有正在连接的用户：';
    // print_r($userFdList);
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) use (&$userFdList) {
	echo '所有正在连接的用户：';
    print_r($userFdList);
	echo 'Message:<pre>';
	$data = json_decode($frame->data , true);
    print_r($data);

    if($data['type'] == 1){
    	$ws->push($userFdList[$data['uid']], "系统：{$data['msg']}");
    } else if( !isset($userFdList[$data['to_uid']])) {
    	$ws->push($userFdList[$data['uid']], "系统：用户没上线");
    } else {
    	$ws->push($userFdList[$data['to_uid']], "别人(uid:{$data['uid']})：{$data['msg']}");
    }
    
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) use (&$userFdList) {

	foreach ($userFdList as $key => $value) {
		if( $value == $fd ) unset($userFdList[$key]);
	}
    echo "client-{$fd} is closed\n";
});

$ws->start();
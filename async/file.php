<?php

swoole_async_set([
	'thread_num' => 2 ,
	'aio_mode'   => SWOOLE_AIO_BASE ,
	'log_file'   => './log/error.txt',
	'disable_dns_cache' => true,
	'dns_lookup_random' => true,
]);

// swoole_async_readfile('./test.php', function($fileName , $content){
// 	var_dump($content);
// });


// $file_content = 'asdfasfasdffffffffffffasfasdfasfasfasfasfasdfasfasfasfasdf';
// swoole_async_writefile('./test.php', $file_content, function($filename) {
//     echo "wirte ok.\n";
// }, $flags = 0);


// swoole_async_read('./test.php' ,function($fileName , $content){
// 	echo '--------------------------';
// 	var_dump($content);
// } , 5);


// $file_content = '11111111111111111111111111112222222222222222222222222222333333333333333333';
// swoole_async_write('./test.php', $file_content,$offset = -1, function($filename, $content){
// 	echo '--------------------------';
// 	var_dump($content);
// });


swoole_async_dns_lookup("www.baidu.com", function($host, $ip){
    echo "{$host} : {$ip}\n";
});


$pid = Swoole\Async::exec("pwd", function ($result, $status) {
    var_dump($result, $status);
});
var_dump($pid);
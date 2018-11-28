<?php


// $process = new swoole_process('callback_function', true);

// $pid = $process->start();

// echo "from exec: ". $process->read(). "\n";

// function callback_function(swoole_process $worker)
// {
//     // $worker->exec('/usr/local/php/bin/php', array(__DIR__.'/../async/test.php'));

//     $worker->write('Hello2');
// }

// swoole_process::wait();


$process = new swoole_process(function (swoole_process $process) {

	sleep(5);
    $process->write('Hello');
    
}, true);

$process->start();
$process->setTimeout(0.5);
// usleep(100);

echo $process->read(); // 输出 Hello


// $process = new swoole_process('callback_function_async', true);
// function callback_function_async(swoole_process $worker)
// {
//     $GLOBALS['worker'] = $worker;
//     swoole_event_add($worker->pipe, function($pipe) {
//         $worker = $GLOBALS['worker'];
//         $recv = $worker->read();

//         echo "From Master: $recv\n";

//         //send data to master
//         $worker->write("hello master\n");

//         sleep(2);

//         $worker->exit(0);
//     });
// }


// 获取错误码
var_dump(swoole_errno());
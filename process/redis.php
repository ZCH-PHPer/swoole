<?php

$redis = new \Redis;
$redis->connect('127.0.0.1', 6379);

function callback_function () {
	global $redis;
    
    swoole_timer_after(10000, function () use($redis) {
        //echo "hello world";
        var_dump($redis);
    });

};

swoole_timer_tick(1000, function () {
    echo "parent timer\n";
});

swoole_process::signal(SIGCHLD, function ($sig) {
    while ($ret = Swoole\Process::wait(false)) {
         // create a new child process
        $p = new Swoole\Process('callback_function');
        $p->start();
    }
});

// create a new child process
$p = new Swoole\Process('callback_function');

swoole_event_add($p->pipe, function ($pipe) use ($p) {
    echo $p->read();
});

$p->start();
<?php

$lock = new swoole_lock(SWOOLE_MUTEX);
echo "[Master]create lock\n";
$lock->lock();

$p = pcntl_fork();
var_dump($p);  // 主进程返回子进程id ； 子进程返回 0；
if ($p > 0)
{
	// 主进程
    sleep(10);
    echo "[Master]\n";
    $lock->unlock();
} 
else
{
	// 子进程
    echo "[Child] Wait Lock\n";
    $lock->lock();
    echo "[Child] Get Lock\n";
    $lock->unlock();
    exit("[Child] exit\n");
}
echo "[Master]release lock\n";
unset($lock);
sleep(1);
echo "[Master]exit\n";
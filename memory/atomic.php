<?php

// 是swoole扩展提供的原子计数操作类，可以方便整数的无锁原子增减。
$atomic = new swoole_atomic(123);
echo $atomic->add(12)."\n";
echo $atomic->sub(11)."\n";
echo $atomic->cmpset(122, 999)."\n";
echo $atomic->cmpset(124, 999)."\n";
echo $atomic->get()."\n";

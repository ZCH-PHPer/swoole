<?php


$id1 = swoole_timer_tick(2000, function ($timer_id) {
    echo "tick-2000ms\n";
});

//3000ms后执行此函数
$id2 = swoole_timer_after(3000, function () {
    echo "after 3000ms.\n";
});


echo $id1 . '\n' . $id2;
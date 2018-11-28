<?php

// $id1 = swoole_timer_tick(2000, function ($timer_id) {
//     echo "tick-2000ms\n";
// });

// //3000ms后执行此函数
// $id2 = swoole_timer_after(3000, function () {
//     echo "after 3000ms.\n";
// });


//echo $id1 . '\n' . $id2;


// $n = 1;
// swoole_timer_tick(3000, function () use (&$n) {
	
//     echo "after 3000ms - $n \n";
//     swoole_timer_after(14000, function () use ($n) {
//         echo "after 14000ms. - $n \n";
//     });

//     $n ++;

// });
// 


$timer = swoole_timer_after(1000, function(){
    echo "timeout\n";
});

var_dump(swoole_timer_clear($timer));
var_dump($timer);
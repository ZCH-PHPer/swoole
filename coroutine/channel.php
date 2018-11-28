<?php


use Swoole\Coroutine as co;
$chan = new co\Channel(1);
co::create(function () use ($chan) {
    for($i = 0; $i < 3; $i++) {
        
        $chan->push(['rand' => rand(1000, 9999), 'index' => $i]);
        echo "$i\n";
        $chan->push(['rand' => rand(1000, 9999), 'index' => $i]);
        echo "$i\n";
        $chan->push(['rand' => rand(1000, 9999), 'index' => $i]);
        echo "$i\n";
    }
});

var_dump('------- 1 -------');

co::create(function () use ($chan) {
    while(1) {
    	co::sleep(1);
        $data = $chan->pop();
        var_dump($data);

        echo '------------ 3 ------------';
        var_dump( $chan->stats() );
        var_dump( $chan->length() );
        var_dump( $chan->isFull() );
        var_dump( $chan->capacity );
        var_dump( $chan->errCode );


    }
});
swoole_event::wait();

var_dump('------- 2 -------');
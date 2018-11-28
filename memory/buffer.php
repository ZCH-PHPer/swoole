<?php

$buffer = new swoole_buffer(1024);

$buffer->append('abcdefghijklmnopqrstuvwxyz');
$res = $buffer->substr( 0, $length = -1, $remove = true);

// $buffer->clear();

$buffer->expand(2048);
$buffer->write(20 , '123456');
$buffer->recycle();
$res2 = $buffer->read( 0 , 26);


var_dump($res);
var_dump($res2);
echo 'used buffer: ' . $buffer->length . "\n" ;
echo 'all buffer : ' . $buffer->capacity . "\n";
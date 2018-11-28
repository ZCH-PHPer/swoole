<?php

$socket = new Co\Socket(AF_INET, SOCK_STREAM, 0);


// client端
go(function () use ($socket) {
    $retval = $socket->connect('localhost', 9601);
    while ($retval)
    {
        $n = $socket->send("hello");
        var_dump($n);

        $data = $socket->recv();
        var_dump($data);

        if (empty($data)) {
            $socket->close();
            break;
        }
        co::sleep(1.0);
    }
    var_dump($retval, $socket->errCode);
});

var_dump('------------------------------------');



// server端
// $socket->bind('127.0.0.1', 9601 );
// $socket->listen(2);

// go(function () use ($socket) {
//     while(true) {
//         echo "Accept: \n";
//         $client = $socket->accept();
//         if ($client === false) {
//             var_dump($socket->errCode);
//         } else {
//             var_dump($client);
//         }
//     }
// });
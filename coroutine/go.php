<?php


// go 创建一个新的协程
// go(function() {
//     go(function () {
//         co::sleep(3.0);
//         go(function () {
//             co::sleep(2.0);
//             echo Swoole\Coroutine::getuid();
//             echo "co[3] end\n";
//         });
//         echo Swoole\Coroutine::getuid();
//         echo "co[2] end\n";
//     });

//     co::sleep(1.0);
//     echo Swoole\Coroutine::getuid();
//     echo "co[1] end\n";
// });



// use Swoole\Coroutine as co;
// $id = go(function(){
//     $id = co::getUid();
//     echo "start coro $id\n";
//     co::suspend(); // 挂起这个协程
//     echo "resume coro $id @1\n";
//     co::suspend();
//     echo "resume coro $id @2\n";
// });
// var_dump($id);
// echo "start to resume $id @1\n";
// co::resume($id); // 重启协程
// echo "start to resume $id @2\n";
// co::resume($id);
// echo "main\n";



use Swoole\Coroutine as co;
$fp = fopen(__DIR__ . "/filehandle.php", "r+");
$filename = __DIR__ . "/filehandle.php";
co::create(function () use ($fp , $filename)
{

    fseek($fp, 0);
    $r = co::fread($fp);
    var_dump($r);

    $r =  co::fwrite($fp, "hello world\n", 5);
    var_dump($r);

    $r =  co::fgets($fp);
    var_dump($r);
    
    echo 'beginSleep:';
    co::sleep(1);
    echo 'endSleep:';

    var_dump('--------------------------------');


    $ip = co::gethostbyname("movie.32farm.top");
    var_dump($ip);


    // var_dump( swoole_async_dns_lookup_coro("movie.32farm.top") );

    // $array = co::getaddrinfo("www.baidu.com");
    // var_dump($array);

    $shell = co::exec('pwd');
    var_dump($shell);


    $r =  co::readFile($filename);
    var_dump($r);


    //var_dump(Swoole\Coroutine::stats());
    //
    
    var_dump('--------------------------------');
    $coros = co::listCoroutines();
	foreach($coros as $cid)
	{
	    var_dump(Coroutine::getBackTrace($cid));
	}

});





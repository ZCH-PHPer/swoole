<?php
$db = new swoole_mysql();

$server = array(
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => '12111111111111111111',
        'database' => 'beauty_table',
        'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
    );

$db->connect($server, function ($db, $r) {
    if ($r === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die;
    }
    $sql = 'show tables';



    // $row = '';
    // for($i=0 ; $i<1018; $i++){
    // 	$row .= "`id{$i}` int(11) NOT NULL,";
    // }

    // $row = rtrim($row , ',');
    
    // $sql = " create table if not exists test ({$row}) ENGINE=InnoDB DEFAULT CHARSET=utf8;";





    $db->query($sql, function(swoole_mysql $db, $r) {
        if ($r === false)
        {
            var_dump($db->error, $db->errno);
        }
        elseif ($r === true )
        {
            var_dump($db->affected_rows, $db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});

$db->on('Close', function($db){
    echo "MySQL connection is closed.\n";
});
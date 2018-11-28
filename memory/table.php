<?php

use Swoole\Table;
$table = new Table(1000 ); // 内存表行

// 内存表列
$table->column('data',Table::TYPE_STRING, 10);
$table->column('pad',Table::TYPE_STRING, 10);
$table->column('id',Table::TYPE_STRING, 10);
$table->column('name',Table::TYPE_STRING, 10);
$table->column('age',Table::TYPE_STRING, 10);

// 创建内存表
$table->create();

// 在表上写数据
$table->set('1', ['id' => 1, 'name' => 'test1', 'age' => 20, 'data' => 1111 , 'pad' => 222 ]);
$table->set('2', ['id' => 2, 'name' => 'test2', 'age' => 21, 'data' => 1111 , 'pad' => 222 ]);
$table->set('3', ['id' => 3, 'name' => 'test3', 'age' => 19, 'data' => 1111 , 'pad' => 222 ]);

var_dump($table->del('1'));

var_dump($table->get('1'));
var_dump($table);
var_dump($table->exist(3));

var_dump($table->count());
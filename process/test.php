<?php

$GLOBALS['test'] = 123;


$test = 456;

function aa(){
	$GLOBALS['test2'] = 789;
}

aa();

var_dump($GLOBALS);
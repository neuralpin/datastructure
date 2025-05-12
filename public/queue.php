<?php

use Neuralpin\DataStructure\Queue;

require __DIR__.'/../vendor/autoload.php';

$MyQueue = new Queue;
$MyQueue->push(1);
$MyQueue->push(2);
$MyQueue->push(3);
$MyQueue->push(4);
$MyQueue->push(5);
// var_dump($MyQueue);
// var_dump($MyQueue->peek());

// var_dump($MyQueue->peek());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->peek());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue);

// $MyQueue->push(1);
// $MyQueue->push(2);
// $MyQueue->clear();
// var_dump($MyQueue->isEmpty());

foreach ($MyQueue as $k => $v) {
    var_dump("$k => $v");
}
var_dump(json_encode($MyQueue));

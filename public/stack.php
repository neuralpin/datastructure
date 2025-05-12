<?php

use Neuralpin\DataStructure\Stack;

require __DIR__.'/../vendor/autoload.php';

$MyStack = new Stack;
$MyStack->push(1);
$MyStack->push(2);
$MyStack->push(3);
$MyStack->push(4);
$MyStack->push(5);
// var_dump($MyStack);
// var_dump($MyStack->peek());

// var_dump($MyStack->pop());
// var_dump($MyStack->pop());
// var_dump($MyStack->pop());
// var_dump($MyStack->pop());
// var_dump($MyStack->pop());
// var_dump($MyStack);

// $MyStack->push(1);
// $MyStack->push(2);
// $MyStack->clear();
// var_dump($MyStack->isEmpty());

foreach ($MyStack as $k => $v) {
    var_dump("{$k} => {$v}");
}
var_dump(json_encode($MyStack));

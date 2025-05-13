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

// Stack Sorting algorithm

$Values = new Stack;
$Values->push(34);
$Values->push(3);
$Values->push(31);
$Values->push(98);
$Values->push(92);
$Values->push(23);

$SortedStack = new Stack;
while (! $Values->isEmpty()) {
    $temporal = $Values->pop();
    while (! $SortedStack->isEmpty() && $SortedStack->peek() < $temporal) {
        $Values->push($SortedStack->pop());
    }
    $SortedStack->push($temporal);
}

var_dump($SortedStack);

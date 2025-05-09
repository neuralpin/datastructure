<?php

use Neuralpin\DataStructure\PriorityQueue;

require __DIR__ . '/../vendor/autoload.php';

$Queue = new PriorityQueue();

$Queue->push('Send welcome-mail', 1);
$Queue->push('Discount inventory', 10);
$Queue->push('Generate order', 100);
$Queue->push('Generate dayly report', 1);

// foreach($Queue as $k => $Task){
//     var_dump($Task);
// }

// var_dump($Queue);

var_dump(count($Queue));
var_dump($Queue->peek());
var_dump([...$Queue]);
var_dump(count($Queue));
var_dump($Queue->isEmpty());


// $Queue = new PriorityQueue();

// $Queue->push('Send welcome-mail', 1);
// $Queue->push('Discount inventory', 10);
// $Queue->push('Generate order', 100);
// $Queue->push('Generate dayly report', 1);

// $Queue->clear();
// var_dump([...$Queue]);
// var_dump(count($Queue));
// var_dump($Queue->isEmpty());
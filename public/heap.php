<?php

declare(strict_types=1);

use Neuralpin\DataStructure\Heap;

require __DIR__.'/../vendor/autoload.php';

$values = [
    ['key' => 28, 'value' => 28],
    ['key' => 49, 'value' => 49],
    ['key' => 99, 'value' => 99],
    ['key' => 10, 'value' => 10],
    ['key' => 36, 'value' => 36],
    ['key' => 22, 'value' => 22],
    ['key' => 22, 'value' => 22],
    ['key' => 25, 'value' => 25],
    ['key' => 44, 'value' => 44],
    ['key' => 63, 'value' => 63],
];
$Heap = new Heap;

var_dump(json_encode($values));
array_walk(
    $values,
    fn ($item) => $Heap->push($item['key'], $item['value'])
);
var_dump($Heap->peek());
var_dump($Heap);
// foreach($Heap as $k => $v){
//     var_dump("$k => $v");
// }
// array_walk(
//     $values,
//     fn() => var_dump($Heap->pop()->value)
// );

$MyHeap = new Heap;
$MyHeap->push(M_PI, M_PI);
$MyHeap->push(0, 0);
$MyHeap->push(-24, -24);
$MyHeap->push(24, 24);
$MyHeap->push(-83, -83);
$MyHeap->push(24, 24);
var_dump($MyHeap);

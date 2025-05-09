<?php

use Neuralpin\DataStructure\MaxHeap;

require __DIR__.'/../vendor/autoload.php';

$Heap = new MaxHeap;
$values = [
    ['key' => 99, 'value' => 99], 
    ['key' => 10, 'value' => 10], 
    ['key' => 28, 'value' => 28], 
    ['key' => 49, 'value' => 49], 
    ['key' => 36, 'value' => 36], 
    ['key' => 22, 'value' => 22], 
    ['key' => 22, 'value' => 22], 
    ['key' => 25, 'value' => 25], 
    ['key' => 44, 'value' => 44], 
    ['key' => 63, 'value' => 63],
];

var_dump(json_encode($values));
array_walk($values, fn($item)=> $Heap->insert($item['key'], $item['value']));
array_walk($values, fn() => var_dump($Heap->extractMax()->value));


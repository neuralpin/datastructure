<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Neuralpin\DataStructure\LinkedListNode;

require __DIR__.'/LinkedListNode.php';

class BasicLinkedList
{
    protected ?LinkedListNode $top = null;

    protected ?LinkedListNode $bottom = null;

    public function push(mixed $Item): LinkedListNode
    {
        $newNode = new LinkedListNode($Item);

        if (!isset($this->top)) {
            $this->top = $newNode;
        }

        if (isset($this->bottom)) {
            $this->bottom->next = $newNode;
        }

        $this->bottom = $newNode;

        return $newNode;
    }

    public function pop(): mixed
    {
        $node = $this->top;

        $this->top = $this->top?->next;

        if($this->bottom === $node){
            $this->bottom = null;
        }

        return $node?->value;
    }

    public function clear(): void
    {
        $this->top = null;
        $this->bottom = null;
    }

    public function __debugInfo(): array
    {
        $data = [];
        $current = $this->top;
        while($current){
            $data[] = $current->value;
            $current = $current?->next;
        }

        return $data;
    }
}

$MyList = new BasicLinkedList;
var_dump($MyList->push('Index'));
var_dump($MyList->push('Computer science'));
$MyList->push('Algorithms');
$MyList->push('Data Structures');

var_dump($MyList);


var_dump($MyList->pop());
var_dump($MyList->pop());
var_dump($MyList);


$BreadcrumbList = [
    (object) [
        'id' => 123,
        'title' => 'Index',
        'parent' => 0,
    ],
    (object) [
        'id' => 124,
        'title' => 'Computer science',
        'parent' => 123,
    ],
    (object) [
        'id' => 234,
        'title' => 'Algorithms',
        'parent' => 124,
    ],
    (object) [
        'id' => 456,
        'title' => 'Data Structures',
        'parent' => 234,
    ],
];

$BreadcrumbMap = [];
$List = null;
foreach($BreadcrumbList as $Item){
    $BreadcrumbMap[$Item->id] = new LinkedListNode($Item);

    if(isset($BreadcrumbMap[$Item->parent])){
        $BreadcrumbMap[$Item->parent]->next = $BreadcrumbMap[$Item->id];
    }

    if($Item->parent === 0){
        $List = $BreadcrumbMap[$Item->id];
    }
}

var_dump($List);
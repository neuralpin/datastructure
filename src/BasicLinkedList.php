<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
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

    public function isEmpty(): bool
    {
        return is_null($this->top);
    }

    public function top(): LinkedListNode|null
    {
        return $this->top;
    }

    public function bottom(): LinkedListNode|null
    {
        return $this->bottom;
    }

    public function unshift(mixed $Item): LinkedListNode
    {
        $newNode = new LinkedListNode($Item);

        if (!isset($this->bottom)) {
            $this->bottom = $newNode;
        }

        if (isset($this->top)) {
            $newNode->next = $this->top;
        }

        $this->top = $newNode;

        return $newNode;
    }

    public function toArray(): array
    {
        $data = [];
        $current = $this->top();
        while ($current) {
            $data[] = $current->value;
            $current = $current?->next;
        }

        return $data;
    }

    public function __debugInfo(): array
    {
        return $this->toArray();
    }

    function generator(): Generator
    {
        $current = $this->top();
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->next;
            $key++;
        }
    }

    public function shift(): mixed
    {
        $bottom = $this->bottom();
        $current = $this->top();
        while($current) {
            if($current->next === $bottom){
                $current->next = null;
                $this->bottom = $current;
                break;
            }
            $current = $current?->next;
        }

        return $bottom->value;
    }

}

$MyList = new BasicLinkedList;
$MyList->push('Computer science');
$MyList->push('Algorithms');
$MyList->push('Data Structures');

$MyList->unshift('Index');

// var_dump($MyList);

var_dump($MyList->shift());

foreach ($MyList->generator() as $k => $v) {
    var_dump("{$k} => {$v}");
}


// var_dump($MyList->pop());
// var_dump($MyList->pop());
// var_dump($MyList);

// $BreadcrumbList = [
//     (object) [
//         'id' => 456,
//         'title' => 'Data Structures',
//         'parent' => 234,
//     ],
//     (object) [
//         'id' => 124,
//         'title' => 'Computer science',
//         'parent' => 123,
//     ],
//     (object) [
//         'id' => 234,
//         'title' => 'Algorithms',
//         'parent' => 124,
//     ],
//     (object) [
//         'id' => 123,
//         'title' => 'Index',
//         'parent' => 0,
//     ],
// ];

// $BreadcrumbMap = [];
// $List = null;
// foreach($BreadcrumbList as $Item){
//     $BreadcrumbMap[$Item->id] = new LinkedListNode($Item);

//     if($Item->parent === 0){
//         $List = $BreadcrumbMap[$Item->id];
//     }
// }

// foreach ($BreadcrumbMap as $Item) {
//     if (isset($BreadcrumbMap[$Item->value->parent])) {
//         $BreadcrumbMap[$Item->value->parent]->next = $BreadcrumbMap[$Item->value->id];
//     }
// }

// var_dump($List);
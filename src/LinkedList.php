<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;

require __DIR__.'/LinkedListNode.php';

class LinkedList
{
    protected ?LinkedListNode $top = null;

    protected ?LinkedListNode $bottom = null;

    /**
     * Add a new element to the bottom of the list
     */
    public function push(mixed $Item): LinkedListNode
    {
        $newNode = new LinkedListNode($Item, $this);

        if (! isset($this->top)) {
            $this->top = $newNode;
        }

        if (isset($this->bottom)) {
            $this->bottom->next = $newNode;
        }

        $this->bottom = $newNode;

        return $newNode;
    }

    /**
     * Return and remove the element at the bottom of the list
     */
    public function pop(): mixed
    {
        $bottom = $this->bottom();
        $current = $this->top();

        if ($current === $bottom) {
            $this->top = null;
            $this->bottom = null;

            return $current?->value;
        }

        while ($current) {
            if ($current->next === $bottom) {
                $current->next = null;
                $this->bottom = $current;
                break;
            }
            $current = $current?->next;
        }

        return $bottom?->value;
    }

    /**
     * Remove all elements from the list
     */
    public function clear(): void
    {
        $this->top = null;
        $this->bottom = null;
    }

    public function isEmpty(): bool
    {
        return is_null($this->top);
    }

    public function top(): ?LinkedListNode
    {
        return $this->top;
    }

    public function bottom(): ?LinkedListNode
    {
        return $this->bottom;
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

    /**
     * Algorithm for list iterating using generators
     */
    public function generator(): Generator
    {
        $current = $this->top();
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->next;
            $key++;
        }
    }

    /**
     * Return and remove the top element of the list
     */
    public function shift(): mixed
    {
        $node = $this->top;

        $this->top = $this->top?->next;

        if ($this->bottom === $node) {
            $this->bottom = null;
        }

        return $node?->value;
    }

    /**
     * Insert an element at the top of the list
     */
    public function unshift(mixed $Item): LinkedListNode
    {
        $newNode = new LinkedListNode($Item, $this);

        if (! isset($this->bottom)) {
            $this->bottom = $newNode;
        }

        if (isset($this->top)) {
            $newNode->next = $this->top;
        }

        $this->top = $newNode;

        return $newNode;
    }
}

$MyList = new LinkedList;
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

<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
use IteratorAggregate;
use JsonSerializable;

require __DIR__.'/DoubleLinkedListNode.php';

class DoubleLinkedList implements IteratorAggregate, JsonSerializable
{
    protected ?DoubleLinkedListNode $top = null;

    protected ?DoubleLinkedListNode $bottom = null;

    /**
     * Add a new element to the bottom of the list
     */
    public function push(mixed $Item): DoubleLinkedListNode
    {
        $newNode = new DoubleLinkedListNode($Item, $this);

        if (! isset($this->top)) {
            $this->top = $newNode;
        }

        if (isset($this->bottom)) {
            $this->bottom->next = $newNode;
            $newNode->prev = $this->bottom;
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

        if ($bottom === $this->top) {
            $this->top = null;
            $this->bottom = null;

            return $bottom?->value;
        }

        $this->bottom = $bottom->prev;

        $bottom->next = null;
        $bottom->prev = null;

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

    public function top(): ?DoubleLinkedListNode
    {
        return $this->top;
    }

    public function bottom(): ?DoubleLinkedListNode
    {
        return $this->bottom;
    }

    /**
     * Algorithm for list iterating using generators starting from the bottom
     */
    public function getReverseIterator(): Generator
    {
        $current = $this->bottom();
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->prev;
            $key++;
        }
    }

    /**
     * Return and remove the top element of the list
     */
    public function shift(): mixed
    {
        $top = $this->top();

        if ($top === $this->bottom) {
            $this->top = null;
            $this->bottom = null;

            return $top?->value;
        }

        $this->top = $top->next;

        $top->next = null;
        $top->prev = null;

        return $top?->value;
    }

    /**
     * Insert an element at the top of the list
     */
    public function unshift(mixed $Item): DoubleLinkedListNode
    {
        $newNode = new DoubleLinkedListNode($Item, $this);

        if (! isset($this->bottom)) {
            $this->bottom = $newNode;
        }

        if (isset($this->top)) {
            $this->top->prev = $newNode;
            $newNode->next = $this->top;
        }

        $this->top = $newNode;

        return $newNode;
    }

    public function remove(DoubleLinkedListNode $node)
    {
        if (isset($node->next) && isset($node->prev)) {
            $node->prev->next = $node->next;
            $node->next->prev = $node->prev;
        } elseif (isset($node->next) && ! isset($node->prev)) {
            $node->next->prev = null;
            $this->top = $node->next;
        } elseif (! isset($node->next) && isset($node->prev)) {
            $node->prev->next = null;
            $this->bottom = $node->prev;
        } else {
            $this->top = null;
            $this->bottom = null;
        }

        $node->next = null;
        $node->prev = null;
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

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Algorithm for list iterating using generators
     */
    public function getIterator(): Generator
    {
        $current = $this->top();
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->next;
            $key++;
        }
    }
}

$MyList = new DoubleLinkedList;
$MyList->push('Computer science');
$MyList->push('Algorithms');
$MyList->push('Data Structures');

// $MyList->unshift('Index');

// // var_dump($MyList);

// var_dump($MyList->shift());

foreach ($MyList as $k => $v) {
    var_dump("{$k} => {$v}");
}

var_dump(json_encode($MyList));

// $EmptyList = new DoubleLinkedList;
// var_dump([
//     'top' => $EmptyList->top(),
//     'bottom' => $EmptyList->bottom(),
// ]);
// var_dump($EmptyList->shift());
// var_dump($EmptyList->pop());
// var_dump($EmptyList);

// foreach ($EmptyList->generator() as $k => $v) {
//     var_dump("{$k} => {$v}");
// }

// $SingleElement = new DoubleLinkedList;
// $SingleElement->push('lorem');
// var_dump([
//     'top' => $SingleElement->top(),
//     'bottom' => $SingleElement->bottom(),
// ]);
// var_dump($SingleElement->pop());
// var_dump($SingleElement);

// foreach ($SingleElement->generator() as $k => $v) {
//     var_dump("{$k} => {$v}");
// }

// $ShitTest = new DoubleLinkedList;
// $ShitTest->unshift('lorem');
// $ShitTest->unshift('ipsum');
// var_dump([
//     'top' => $ShitTest->top(),
//     'bottom' => $ShitTest->bottom(),
// ]);
// var_dump($ShitTest->shift());
// var_dump($ShitTest);

// $ReverseTest = new DoubleLinkedList;
// $ReverseTest->push(1);
// $ReverseTest->push(2);
// $ReverseTest->push(3);
// $ReverseTest->push(4);
// $ReverseTest->push(5);
// $ReverseTest->unshift(0);
// foreach($ReverseTest->generator() as $value){
//     var_dump($value);
// }
// foreach($ReverseTest->reverseGenerator() as $value){
//     var_dump($value);
// }

// $RemovingTest = new DoubleLinkedList;
// $nodeFirst = $RemovingTest->push(1);
// $nodeSecond = $RemovingTest->push(2);
// $nodeThird = $RemovingTest->push(3);

// $nodeSecond->remove();
// foreach ($RemovingTest->generator() as $value) {
//     var_dump($value);
// }
// // var_dump($nodeSecond);

// $nodeFirst->remove();
// var_dump($RemovingTest);

// $nodeThird->remove();
// var_dump($RemovingTest);

// $RemovingFromBotomTest = new DoubleLinkedList;
// $nodeFirst = $RemovingFromBotomTest->push(1);
// $nodeSecond = $RemovingFromBotomTest->push(2);
// $nodeSecond->remove();
// var_dump($RemovingFromBotomTest);

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
//     $BreadcrumbMap[$Item->id] = new DoubleLinkedListNode($Item);

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

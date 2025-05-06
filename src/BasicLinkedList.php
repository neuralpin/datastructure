<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Neuralpin\DataStructure\LinkedListNode;

require __DIR__.'/LinkedListNode.php';

class BasicLinkedList
{
    protected array $data = [];

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
$MyList->push('Index');
$MyList->push('Computer science');
$MyList->push('Algorithms');
$MyList->push('Data Structures');

var_dump($MyList);


var_dump($MyList->pop());
var_dump($MyList->pop());
var_dump($MyList);
<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

require __DIR__.'/ListNode.php';

class Queue
{
    protected ?ListNode $front = null;

    protected ?ListNode $back = null;

    /**
     * Remove all elements from the list
     */
    public function clear(): void
    {
        $this->front = null;
        $this->back = null;
    }

    public function isEmpty(): bool
    {
        return is_null($this->front);
    }

    public function peek(): ?ListNode
    {
        return $this->front;
    }

    public function toArray(): array
    {
        $data = [];
        $current = $this->peek();
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
     * Removes and returns the element at the front of the queue
     */
    public function pop(): mixed
    {
        $node = $this->front;

        $this->front = $this->front?->next;

        if ($this->back === $node) {
            $this->back = null;
        }

        return $node?->value;
    }

    /**
     * Pushes values into the queue
     */
    public function push(mixed $Item)
    {
        $newNode = new ListNode($Item);

        if (!isset($this->front)) {
            $this->front = $newNode;
        }

        if (isset($this->back)) {
            $this->back->next = $newNode;
        }

        $this->back = $newNode;
    }
}

$MyQueue = new Queue;
$MyQueue->push(1);
$MyQueue->push(2);
$MyQueue->push(3);
$MyQueue->push(4);
$MyQueue->push(5);
var_dump($MyQueue);
// var_dump($MyQueue->peek());

// var_dump($MyQueue->peek());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->peek());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue->pop());
// var_dump($MyQueue);

// $MyQueue->push(1);
// $MyQueue->push(2);
// $MyQueue->clear();
// var_dump($MyQueue->isEmpty());

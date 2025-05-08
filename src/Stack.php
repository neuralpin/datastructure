<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

require __DIR__.'/StackNode.php';

class Stack
{
    protected ?ListNode $top = null;

    protected ?ListNode $bottom = null;

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

    public function peek(): ?ListNode
    {
        return $this->top;
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
     * Removes and returns the element at the top of the stack
     */
    public function pop(): mixed
    {
        $node = $this->top;

        $this->top = $this->top?->next;

        if ($this->bottom === $node) {
            $this->bottom = null;
        }

        return $node?->value;
    }

    /**
     * Insert an element at the top of the stack
     */
    public function push(mixed $Item)
    {
        $newNode = new ListNode($Item);

        if (! isset($this->bottom)) {
            $this->bottom = $newNode;
        }

        if (isset($this->top)) {
            $newNode->next = $this->top;
        }

        $this->top = $newNode;
    }
}

$MyStack = new Stack;
$MyStack->push(1);
$MyStack->push(2);
$MyStack->push(3);
$MyStack->push(4);
$MyStack->push(5);
// var_dump($MyStack);
// var_dump($MyStack->peek());

var_dump($MyStack->pop());
var_dump($MyStack->pop());
var_dump($MyStack->pop());
var_dump($MyStack->pop());
var_dump($MyStack->pop());
var_dump($MyStack);

$MyStack->push(1);
$MyStack->push(2);
$MyStack->clear();
var_dump($MyStack->isEmpty());

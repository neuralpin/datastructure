<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
use IteratorAggregate;
use JsonSerializable;

class Stack implements IteratorAggregate, JsonSerializable
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

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getIterator(): Generator
    {
        $current = $this->top;
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->next;
            $key++;
        }
    }
}

<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
use IteratorAggregate;
use JsonSerializable;

class Queue implements IteratorAggregate, JsonSerializable
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

        if (! isset($this->front)) {
            $this->front = $newNode;
        }

        if (isset($this->back)) {
            $this->back->next = $newNode;
        }

        $this->back = $newNode;
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
        $current = $this->peek();
        $key = 0;
        while ($current) {
            yield $key => $current->value;
            $current = $current?->next;
            $key++;
        }
    }
}

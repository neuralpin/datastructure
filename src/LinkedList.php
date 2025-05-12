<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
use IteratorAggregate;
use JsonSerializable;

class LinkedList implements IteratorAggregate, JsonSerializable
{
    protected ?ListNode $top = null;

    protected ?ListNode $bottom = null;

    /**
     * Add a new element to the bottom of the list
     */
    public function push(mixed $Item): ListNode
    {
        $newNode = new ListNode($Item);

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

    public function top(): ?ListNode
    {
        return $this->top;
    }

    public function bottom(): ?ListNode
    {
        return $this->bottom;
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
    public function unshift(mixed $Item): ListNode
    {
        $newNode = new ListNode($Item);

        if (! isset($this->bottom)) {
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
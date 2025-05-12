<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Generator;
use IteratorAggregate;
use JsonSerializable;

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
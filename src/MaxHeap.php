<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Countable;
use Generator;
use IteratorAggregate;
use JsonSerializable;

class MaxHeap implements Countable, IteratorAggregate, JsonSerializable
{
    /** @var KeyValuePair[] */
    protected array $heap = [];

    public function push(int $key, mixed $value): void
    {
        $this->heap[] = new KeyValuePair($key, $value);
        $this->bubbleUp(count($this->heap) - 1);
    }

    public function pop(): ?KeyValuePair
    {
        if (empty($this->heap)) {
            return null;
        }

        if (count($this->heap) === 1) {
            return array_pop($this->heap);
        }

        $max = $this->heap[0];
        $lastElement = array_pop($this->heap);
        $this->heap[0] = $lastElement;
        $this->sinkDown(0);

        return $max;
    }

    protected function parent(int $index): ?int
    {
        if ($index <= 0) {
            return null;
        }

        return (int) ($index - 1) >> 1;
    }

    protected function leftChild(int $index): int
    {
        return ($index << 1) + 1;
    }

    protected function rightChild(int $index): int
    {
        return ($index << 1) + 2;
    }

    protected function swap(int $i, int $j): void
    {
        [$this->heap[$i], $this->heap[$j]] = [$this->heap[$j], $this->heap[$i]];
    }

    protected function bubbleUp(int $index): void
    {
        $parent = $this->parent($index);
        while ($index > 0 && $this->heap[$index]->key > $this->heap[$parent]->key) {
            $this->swap($index, $parent);
            $index = $parent;
            $parent = $this->parent($index);
        }
    }

    protected function sinkDown(int $index): void
    {
        $left = $this->leftChild($index);
        $right = $this->rightChild($index);
        $largest = $index;
        $count = count($this->heap);

        if ($left < $count && $this->heap[$left]->key > $this->heap[$largest]->key) {
            $largest = $left;
        }

        if ($right < $count && $this->heap[$right]->key > $this->heap[$largest]->key) {
            $largest = $right;
        }

        if ($largest !== $index) {
            $this->swap($index, $largest);
            $this->sinkDown($largest);
        }
    }

    public function peek(): ?KeyValuePair
    {
        return $this->heap[0] ?? null;
    }

    public function clear(): void
    {
        $this->heap = [];
    }

    public function isEmpty(): bool
    {
        return empty($this->heap);
    }

    public function count(): int
    {
        return count($this->heap);
    }

    public function getIterator(): Generator
    {
        $Heap = clone $this;
        while (! $Heap->isEmpty()) {
            $item = $Heap->pop();
            yield $item->key => $item->value;
        }
    }

    public function toArray(): array
    {
        $data = [];
        foreach ($this as $k => $v) {
            $data[$k] = $v;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __debugInfo(): array
    {
        return $this->toArray();
    }
}

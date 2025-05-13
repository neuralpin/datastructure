<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Countable;
use Generator;
use IteratorAggregate;
use JsonSerializable;
use ValueError;

class Heap implements Countable, IteratorAggregate, JsonSerializable
{
    /** @var KeyValuePair[] */
    protected array $heap = [];

    public function __construct(string $mode = self::MODE_MIN)
    {
        if ($mode !== self::MODE_MAX && $mode !== self::MODE_MIN) {
            throw new ValueError('Mode parameter only accepts symbols ">" or "<"');
        }
        $this->mode = $mode;
    }

    protected string $mode;

    public const string MODE_MAX = '>';

    public const string MODE_MIN = '<';

    public function push(int|float $key, mixed $value): void
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

        $top = $this->heap[0];
        $lastElement = array_pop($this->heap);
        $this->heap[0] = $lastElement;
        $this->sinkDown(0);

        return $top;
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
        while (
            $index > 0
            && $this->compare($this->heap[$index]->key, $this->heap[$parent]->key)
        ) {
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

        if (
            $left < $count
            && $this->compare($this->heap[$left]->key, $this->heap[$largest]->key)
        ) {
            $largest = $left;
        }

        if (
            $right < $count
            && $this->compare($this->heap[$right]->key, $this->heap[$largest]->key)
        ) {
            $largest = $right;
        }

        if ($largest !== $index) {
            $this->swap($index, $largest);
            $this->sinkDown($largest);
        }
    }

    protected function compare(int|float $a, int|float $b): bool
    {
        return ($this->mode === self::MODE_MAX) ? $a > $b : $a < $b;
    }

    public function peek(): mixed
    {
        return $this->heap[0]?->value;
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

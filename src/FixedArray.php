<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use ArrayAccess;
use Countable;
use Exception;
use Generator;
use IteratorAggregate;
use JsonSerializable;
use OutOfRangeException;

class FixedArray implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    protected ?array $data = [];

    protected int $count = 0;

    public function __construct(protected int $size) {}

    public function count(): int
    {
        return $this->count;
    }

    public function capacity(): int
    {
        return $this->size;
    }

    public function push(mixed $element): void
    {
        if ($this->count === $this->size) {
            throw new OutOfRangeException('Out of range');
        }

        $this->data[] = $element;
        $this->count++;
    }

    public function pop(): mixed
    {
        $keys = array_keys($this->data);
        $lastKey = end($keys);
        if (isset($this->data[$lastKey])) {
            $element = $this->data[$lastKey];
            unset($this->data[$lastKey]);
            $this->count--;

            return $element;
        }

        return null;
    }

    public function clear()
    {
        $this->data = [];
        $this->count = 0;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! isset($this->data[$offset]) && $this->count === $this->size) {
            throw new OutOfRangeException('Out of range');
        }

        $this->data[$offset] = $value;
        $this->count++;
    }

    public function offsetUnset(mixed $offset): void
    {
        if (isset($this->data[$offset])) {
            unset($this->data[$offset]);
            $this->count--;
        }
    }

    public function __debugInfo(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }

    /**
     * Algorithm for list iterating using generators
     */
    public function getIterator(): Generator
    {
        foreach ($this->data as $k => $v) {
            yield $k => $v;
        }
    }
}
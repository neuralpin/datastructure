<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Countable;
use Generator;
use IteratorAggregate;
use JsonSerializable;

class Set implements Countable, IteratorAggregate, JsonSerializable
{
    /** * @var array<string|int|float|object> */
    protected array $data;

    /** @param array<string|int|float|object> $elements */
    public function __construct(array $elements)
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    protected function hash(string|int|float|object $element): string
    {
        if (gettype($element) === 'object') {
            return md5((string) spl_object_id($element));
        }

        return md5((string) $element);
    }

    public function add(string|int|float|object $element): void
    {
        $this->data[$this->hash($element)] = $element;
    }

    public function contains(string|int|float|object $element): bool
    {
        return isset($this->data[$this->hash($element)]);
    }

    public function get(int $key): string|int|float|object|null
    {
        $hash = array_keys($this->data)[$key] ?? null;

        return $this->data[$hash] ?? null;
    }

    public function remove(int $key): void
    {
        $hash = array_keys($this->data)[$key] ?? null;
        unset($this->data[$hash]);
    }

    public function clear(): void
    {
        $this->data = [];
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    public function map(callable $callback): self
    {
        return new self(array_map($callback, $this->data));
    }

    public function last(): string|int|float|object|null
    {
        return end($this->data);
    }

    public function first(): string|int|float|object|null
    {
        return array_values($this->data)[0] ?? null;
    }

    public function reduce(callable $callback): mixed
    {
        return array_reduce(array_values($this->data), $callback);
    }

    /**
     * Algorithm for list iterating using generators
     */
    public function getIterator(): Generator
    {
        foreach (array_values($this->data) as $k => $v) {
            yield $k => $v;
        }
    }

    public function toArray(): array
    {
        return array_values($this->data);
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

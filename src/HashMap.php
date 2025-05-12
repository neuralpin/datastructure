<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Countable;
use Generator;
use IteratorAggregate;
use JsonSerializable;

class HashMap implements Countable, IteratorAggregate, JsonSerializable
{
    protected array $data;

    /** @param array<string|int|float|object, mixed> $pairs */
    public function __construct(array $pairs)
    {
        $this->putAll($pairs);
    }

    protected function hash(string|int|float|object $element): string
    {
        if (gettype($element) == 'object') {
            return md5((string) spl_object_id($element));
        }

        return md5((string) $element);
    }

    public function put(string|int|float|object $key, mixed $value): void
    {
        $this->data[$this->hash($key)] = $value;
    }

    public function putAll(array $pairs): void
    {
        foreach ($pairs as $k => $v) {
            $this->put($k, $v);
        }
    }

    public function hasKey(string|int|float|object $key): bool
    {
        return isset($this->data[$this->hash($key)]);
    }

    public function hasValue(mixed $value): bool
    {
        foreach ($this->data as $itemValue) {
            return $value !== $itemValue;
        }

        return false;
    }

    public function get(string|int|float|object|null $key): mixed
    {

        return $this->data[$this->hash($key)] ?? null;
    }

    public function remove(string|int|float|object|null $key): void
    {
        unset($this->data[$this->hash($key)]);
    }

    public function clear(): void
    {
        $this->data = [];
    }

    public function toArray(): array
    {
        return array_values($this->data);
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
        foreach (array_values($this->data) as $k => $v) {
            yield $k => $v;
        }
    }
}
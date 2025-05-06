<?php

class BasicMap
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
            return md5(spl_object_id($element));
        }

        return md5($element);
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
        return array_values($this->data);
    }
}

$test = new BasicMap([
    'color_1' => 'red',
    'color_2' => 'green',
    'value_1' => 3.1415,
]);

var_dump($test->count());
var_dump($test->hasKey('color_2'));
var_dump($test->hasKey('lorem_1'));
var_dump($test->hasValue('green'));
var_dump($test->hasValue('purple'));
var_dump($test->get('color_1'));
var_dump($test->get('value_1'));
var_dump($test->get('lorem_1'));

var_dump($test->toArray());

var_dump($test->map(fn ($item) => gettype($item)));

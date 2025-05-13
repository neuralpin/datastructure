<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class KeyValuePair
{
    public int|float $key;

    public mixed $value;

    public function __construct(int|float $key, mixed $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

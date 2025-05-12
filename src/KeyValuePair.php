<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class KeyValuePair
{
    public int $key;

    public mixed $value;

    public function __construct(int $key, mixed $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

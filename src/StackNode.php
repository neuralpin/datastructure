<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class StackNode
{
    public mixed $value = null {
        get => $this->value;
        set(mixed $value) => $value;
    }

    public ?self $next = null {
        get => $this->next;
        set(?self $next) => $next;
    }

    public function __construct(
        mixed $value
    ) {
        $this->value = $value;
    }

    public function __debugInfo(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}

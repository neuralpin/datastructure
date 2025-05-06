<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class LinkedListNode
{
    public mixed $value = null {
        get => $this->value;
        set(mixed $value) => $value;
    }

    public ?self $next = null {
        get => $this->next;
        set(?self $next) => $next;
    }

    public function __construct(mixed $value, ?self $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}

<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Neuralpin\DataStructure\DoubleLinkedList;

class DoubleLinkedListNode
{
    public mixed $value = null {
        get => $this->value;
        set(mixed $value) => $value;
    }

    public ?self $prev = null {
        get => $this->prev;
        set(?self $prev) => $prev;
    }

    public ?self $next = null {
        get => $this->next;
        set(?self $next) => $next;
    }

    public ?DoubleLinkedList $List = null {
        get => $this->List;
        set(?DoubleLinkedList $List) => $List;
    }

    public function __construct(
        mixed $value, ?DoubleLinkedList $List = null
    ) {
        $this->value = $value;
        $this->List = $List;
    }
}

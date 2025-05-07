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

    protected ?DoubleLinkedList $List;

    public function __construct(
        mixed $value, 
        DoubleLinkedList $List,
    ) {
        $this->value = $value;
        $this->List = $List;
    }

    public function remove()
    {
        $this->List->remove($this);
        $this->List = null;
    }
}

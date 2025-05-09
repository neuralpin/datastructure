<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Countable;
use Generator;
use IteratorAggregate;
use Neuralpin\DataStructure\MaxHeap;

class PriorityQueue implements Countable, IteratorAggregate
{
    protected MaxHeap $MaxHeap;

    protected int $count = 0;
    

    public function __construct()
    {
        $this->MaxHeap = new MaxHeap;
    }


    public function push(mixed $value, int $priority): void
    {
        $this->MaxHeap->insert($priority, $value);
        $this->count++;
    }

    public function pop(): mixed
    {
        $Item = $this->MaxHeap->extractMax();
        if(!is_null($Item)){
            $this->count--;
            return $Item->value;
        }
        return null;
    }

    public function peek(): mixed
    {
        return $this->MaxHeap->peek()->value;
    }

    public function clear():void
    {
        $this->MaxHeap = new MaxHeap;
        $this->count = 0;
    }

    public function isEmpty(): bool
    {
        return empty($this->count);
    }


    public function count(): int
    {
        return $this->count;
    }

    public function getIterator(): Generator
    {
        $Copy = clone $this;
        $key = 0;
        while(!$Copy->isEmpty()){
            yield $key => $Copy->pop();
            $key++;
        }
    }

    public function toArray(): array
    {
        return [...(clone $this)];
    }

}
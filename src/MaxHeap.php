<?php

class MaxHeap
{
    public $heap = [];

    /**
     * Gets the parent index of a given index.
     *
     * @param int $index
     * @return int|null
     */
    protected function parent(int $index): ?int
    {
        if ($index <= 0) {
            return null;
        }
        return floor(($index - 1) / 2);
    }

    /**
     * Gets the left child index of a given index.
     *
     * @param int $index
     * @return int
     */
    protected function leftChild(int $index): int
    {
        return 2 * $index + 1;
    }

    /**
     * Gets the right child index of a given index.
     *
     * @param int $index
     * @return int
     */
    protected function rightChild(int $index): int
    {
        return 2 * $index + 2;
    }

    /**
     * Swaps two elements in the heap.
     *
     * @param int $i
     * @param int $j
     * @return void
     */
    protected function swap(int $i, int $j): void
    {
        [$this->heap[$i], $this->heap[$j]] = [$this->heap[$j], $this->heap[$i]];
    }

    /**
     * Heapifies the heap starting from a given index, ensuring the max-heap property.
     *
     * @param int $index
     * @return void
     */
    protected function heapifyUp(int $index): void
    {
        $parent = $this->parent($index);
        while ($index > 0 && $this->heap[$index] > $this->heap[$parent]) {
            $this->swap($index, $parent);
            $index = $parent;
            $parent = $this->parent($index);
        }
    }

    /**
     * Heapifies the heap starting from a given index, ensuring the max-heap property downwards.
     *
     * @param int $index
     * @return void
     */
    protected function heapifyDown(int $index): void
    {
        $left = $this->leftChild($index);
        $right = $this->rightChild($index);
        $largest = $index;
        $count = count($this->heap);

        if ($left < $count && $this->heap[$left] > $this->heap[$largest]) {
            $largest = $left;
        }

        if ($right < $count && $this->heap[$right] > $this->heap[$largest]) {
            $largest = $right;
        }

        if ($largest !== $index) {
            $this->swap($index, $largest);
            $this->heapifyDown($largest);
        }
    }

    /**
     * Inserts a new value into the max-heap.
     *
     * @param mixed $value
     * @return void
     */
    public function insert($value): void
    {
        $this->heap[] = $value;
        $this->heapifyUp(count($this->heap) - 1);
    }

    /**
     * Extracts the maximum value from the max-heap.
     *
     * @return mixed|null
     */
    public function extractMax()
    {
        if (empty($this->heap)) {
            return null;
        }

        if (count($this->heap) === 1) {
            return array_pop($this->heap);
        }

        $max = $this->heap[0];
        $lastElement = array_pop($this->heap);
        $this->heap[0] = $lastElement;
        $this->heapifyDown(0);

        return $max;
    }

    /**
     * Gets the maximum value in the max-heap without removing it.
     *
     * @return mixed|null
     */
    public function peekMax()
    {
        return $this->heap[0] ?? null;
    }

    /**
     * Checks if the max-heap is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->heap);
    }

    /**
     * Gets the number of elements in the max-heap.
     *
     * @return int
     */
    public function size(): int
    {
        return count($this->heap);
    }

    /**
     * Returns the entire heap array (for debugging or inspection).
     *
     * @return array
     */
    public function getHeap(): array
    {
        return $this->heap;
    }
}

// Example usage:
$maxHeap = new MaxHeap();
$maxHeap->insert(10);
$maxHeap->insert(5);
$maxHeap->insert(15);
$maxHeap->insert(3);
$maxHeap->insert(20);

echo "Max Heap: " . implode(", ", $maxHeap->getHeap()) . "\n"; // Output: Max Heap: 20, 15, 10, 3, 5

echo "Extract Max: " . $maxHeap->extractMax() . "\n"; // Output: Extract Max: 20
echo "Max Heap after extraction: " . implode(", ", $maxHeap->getHeap()) . "\n"; // Output: Max Heap after extraction: 15, 10, 5, 3

echo "Peek Max: " . $maxHeap->peekMax() . "\n"; // Output: Peek Max: 15
echo "Size: " . $maxHeap->size() . "\n"; // Output: Size: 4

$maxHeap->insert(25);
echo "Max Heap after insertion: " . implode(", ", $maxHeap->getHeap()) . "\n"; // Output: Max Heap after insertion: 25, 15, 10, 3, 5

while (!$maxHeap->isEmpty()) {
    echo "Extracting: " . $maxHeap->extractMax() . "\n";
}
// Output:
// Extracting: 25
// Extracting: 15
// Extracting: 10
// Extracting: 5
// Extracting: 3

echo "Is Empty: " . ($maxHeap->isEmpty() ? 'Yes' : 'No') . "\n"; // Output: Is Empty: Yes
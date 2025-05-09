<?php

declare(strict_types=1);

class MaxHeapTree {
    private $root;
    private $nodes = [];

    public function __construct() {
        $this->root = null;
    }

    public function insert($value) {
        $newNode = new class($value){
            public $value;
            public $left;
            public $right;
            public $parent;

            public function __construct($value) {
                $this->value = $value;
                $this->left = null;
                $this->right = null;
                $this->parent = null;
            }
        };

        if ($this->root === null) {
            $this->root = $newNode;
            $this->nodes[] = $newNode;
            return;
        }

        $parentIndex = floor((count($this->nodes) - 1) / 2);
        $parent = $this->nodes[$parentIndex];

        $newNode->parent = $parent;
        if ($parent->left === null) {
            $parent->left = $newNode;
        } else {
            $parent->right = $newNode;
        }

        $this->nodes[] = $newNode;
        $this->heapifyUp($newNode);
    }

    private function heapifyUp($node) {
        while ($node->parent !== null && $node->value > $node->parent->value) {
            $this->swapValues($node, $node->parent);
            $node = $node->parent;
        }
    }

    private function swapValues($node1, $node2) {
        $temp = $node1->value;
        $node1->value = $node2->value;
        $node2->value = $temp;
    }

    public function extractMax()
    {
        if ($this->root === null) {
            return null;
        }
        if (count($this->nodes) === 1) {
            $maxValue = $this->root->value;
            $this->root = null;
            array_pop($this->nodes);
            return $maxValue;
        }

        $maxValue = $this->root->value;
        $lastNode = array_pop($this->nodes);
        $this->root->value = $lastNode->value;

        if ($lastNode->parent !== null) {
            if ($lastNode->parent->right === $lastNode) {
                $lastNode->parent->right = null;
            } else {
                $lastNode->parent->left = null;
            }
        }

        $this->heapifyDown($this->root);
        return $maxValue;
    }

    private function heapifyDown($node)
    {
        while ($node !== null) {
            $largest = $node;
            if ($node->left !== null && $node->left->value > $largest->value) {
                $largest = $node->left;
            }
            if ($node->right !== null && $node->right->value > $largest->value) {
                $largest = $node->right;
            }

            if ($largest === $node) {
                break;
            }

            $this->swapValues($node, $largest);
            $node = $largest;
        }
    }

}

$Heap = new MaxHeapTree;
$values = [99,10,28,49,36,22,22,25,44,63];
foreach($values as $v){
    $Heap->insert($v);
}
var_dump(json_encode($values));
foreach ($values as $v) {
    var_dump($Heap->extractMax());
}
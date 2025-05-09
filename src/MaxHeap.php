<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Neuralpin\DataStructure\KeyValuePair;

class MaxHeap
{
    private ?BinaryTreeNode $root = null;

    private ?BinaryTreeNode $lastInserted = null;

    public function insert(int $key, mixed $value)
    {
        $newNode = new BinaryTreeNode(new KeyValuePair($key, $value));
        if ($this->root === null) {
            $this->root = $newNode;
            $this->lastInserted = $newNode;

            return;
        }

        $parent = $this->findInsertionPoint();
        $newNode->parent = $parent;

        if ($parent->left === null) {
            $parent->left = $newNode;
        } else {
            $parent->right = $newNode;
        }

        $this->lastInserted = $newNode;
        $this->rollUp($newNode);
    }

    private function findInsertionPoint(): BinaryTreeNode|null
    {
        // BFS-like traversal to find the first available parent for insertion
        $queue = [$this->root];
        while (! empty($queue)) {
            $node = array_shift($queue);
            if ($node->left === null || $node->right === null) {
                return $node;
            }
            $queue[] = $node->left;
            $queue[] = $node->right;
        }

        return null;
    }

    private function rollUp(BinaryTreeNode $node): void
    {
        while ($node->parent !== null && $node->key() > $node->parent->key()) {
            $this->swapNodes($node, $node->parent);
            $node = $node->parent;
        }
    }

    private function swapNodes(BinaryTreeNode $node1, BinaryTreeNode $node2): void
    {
        $temp = $node1->value;
        $node1->value = $node2->value;
        $node2->value = $temp;
    }

    public function extractMax(): KeyValuePair|null
    {
        if ($this->root === null) {
            return null;
        }

        $maxValue = $this->root->value;

        if ($this->lastInserted === $this->root) {
            $this->root = null;
            $this->lastInserted = null;

            return $maxValue;
        }

        $this->root->value = $this->lastInserted->value;
        if ($this->lastInserted->parent !== null) {
            if ($this->lastInserted->parent->right === $this->lastInserted) {
                $this->lastInserted->parent->right = null;
            } else {
                $this->lastInserted->parent->left = null;
            }
        }

        $this->lastInserted = $this->findLastInsertedNode();
        $this->rollDown($this->root);

        return $maxValue;
    }

    private function findLastInsertedNode(): BinaryTreeNode|null
    {
        // Traversal to locate the last inserted node (BFS approach)
        $queue = [$this->root];
        $last = null;
        while (! empty($queue)) {
            $node = array_shift($queue);
            $last = $node;
            if ($node->left) {
                $queue[] = $node->left;
            }
            if ($node->right) {
                $queue[] = $node->right;
            }
        }

        return $last;
    }

    private function rollDown(?BinaryTreeNode $node): void
    {
        while ($node !== null) {
            $largest = $node;
            if ($node->left !== null && $node->left->key() > $largest->key()) {
                $largest = $node->left;
            }
            if ($node->right !== null && $node->right->key() > $largest->key()) {
                $largest = $node->right;
            }

            if ($largest === $node) {
                break;
            }

            $this->swapNodes($node, $largest);
            $node = $largest;
        }
    }

    public function peek(): ?KeyValuePair
    {
        return $this->root?->value;
    }

    function __clone(): void
    {
        $this->root = clone $this->root;
        $this->lastInserted = clone $this->lastInserted;
    }
}
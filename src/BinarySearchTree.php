<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class Node
{
    public $value;

    public $left;

    public $right;

    public function __construct($value)
    {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

class BinarySearchTree
{
    public $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function insert($value)
    {
        if ($this->root === null) {
            $this->root = new Node($value);
        } else {
            $this->insertNode($this->root, $value);
        }
    }

    private function insertNode($node, $value)
    {
        if ($value < $node->value) {
            if ($node->left === null) {
                $node->left = new Node($value);
            } else {
                $this->insertNode($node->left, $value);
            }
        } else {
            if ($node->right === null) {
                $node->right = new Node($value);
            } else {
                $this->insertNode($node->right, $value);
            }
        }
    }

    public function search($value)
    {
        return $this->searchNode($this->root, $value);
    }

    private function searchNode($node, $value)
    {
        if ($node === null || $node->value === $value) {
            return $node;
        }
        if ($value < $node->value) {
            return $this->searchNode($node->left, $value);
        } else {
            return $this->searchNode($node->right, $value);
        }
    }

    public function inorderTraversal($node)
    {
        if ($node !== null) {
            $this->inorderTraversal($node->left);
            echo $node->value.' ';
            $this->inorderTraversal($node->right);
        }
    }

    public function preorderTraversal($node)
    {
        if ($node !== null) {
            echo $node->value.' ';
            $this->preorderTraversal($node->left);
            $this->preorderTraversal($node->right);
        }
    }

    public function postorderTraversal($node)
    {
        if ($node !== null) {
            $this->postorderTraversal($node->left);
            $this->postorderTraversal($node->right);
            echo $node->value.' ';
        }
    }
}

// Example usage
$bst = new BinarySearchTree;
$values = [44, 8, 3, 1, 6, 4, 7, 10, 14, 13];

foreach ($values as $value) {
    $bst->insert($value);
}

echo 'Inorder Traversal: ';
$bst->inorderTraversal($bst->root);
echo "\n";

echo 'Preorder Traversal: ';
$bst->preorderTraversal($bst->root);
echo "\n";

echo 'Postorder Traversal: ';
$bst->postorderTraversal($bst->root);
echo "\n";

// Searching for a value
$searchValue = 6;
$result = $bst->search($searchValue);
if ($result) {
    echo "Value $searchValue found in the BST.\n";
} else {
    echo "Value $searchValue not found in the BST.\n";
}

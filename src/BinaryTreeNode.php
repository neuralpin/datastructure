<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

use Neuralpin\DataStructure\KeyValuePair;

class BinaryTreeNode
{
    public KeyValuePair $value;

    public ?self $left = null;

    public ?self $right = null;

    public $parent = null;

    public function __construct(KeyValuePair $value)
    {
        $this->value = $value;
    }

    public function key(): int
    {
        return $this->value->key;
    }

    public function __clone()
    {
        $this->value = clone $this->value;

        if(isset($this->left)){
            $this->left = clone $this->left;
        }

        if(isset($this->right)){
            $this->right = clone $this->right;
        }
    }
}

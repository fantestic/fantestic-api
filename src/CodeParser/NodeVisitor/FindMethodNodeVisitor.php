<?php

declare(strict_types = 1);

namespace App\CodeParser\NodeVisitor;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;

/**
 * Searches for a method inside a node-tree.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 */
class FindMethodNodeVisitor extends NodeVisitorAbstract
{
    private string $methodName;
    private Node $methodNode;

    public function __construct(string $methodName)
    {
        $this->methodName = $methodName;
    }

    public function leaveNode(Node $node) :?int
    {
        if ($node instanceof ClassMethod && $node->name === $this->methodName) {
            $this->methodNode = $node;
            return NodeTraverser::STOP_TRAVERSAL;
        }
        return null;
    }

    public function methodWasFound() :bool
    {
        return !is_null($this->methodNode);
    }

    public function getMethodNode() :?ClassMethod
    {
        return $this->methodNode;
    }
}

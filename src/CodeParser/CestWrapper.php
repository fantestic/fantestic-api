<?php

declare(strict_types = 1);

namespace App\CodeParser;

use PhpParser\BuilderFactory;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\Node;
use App\CodeParser\NodeVisitor\FindMethodNodeVisitor;
use App\CodeParser\NodeVisitor\OverwriteMethodNodeVisitor;
use App\Entity\Scenario;

/**
 * Wraps around a Cest and gives easy access to read and manipulate the Cest.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CestWrapper
{
    private Class_ $classNode;
    private BuilderFactory $factory;

    public function __construct(Class_ $classNode) {
        $this->classNode = $classNode;
        $this->factory = new BuilderFactory();
    }

    public function findScenario(Scenario $scenario) :?ClassMethod
    {
        $visitor = new FindMethodNodeVisitor($scenario->getMethodName());
        $this->traverseClass($visitor);
        return $visitor->getMethodNode();
    }

    public function writeScenario(Scenario $scenario) :self
    {
        $body = $this->buildScenarioBody($scenario);
        $scenarioClassMethod = $this->findScenario($scenario);
        if (is_null($scenarioClassMethod)) {
            $this->addScenario($scenario, $body);
        } else {
            $this->updateScenario($scenario, $body);
        }
        
        return $this;
    }

    public function getStmts() :Node
    {
        return $this->classNode;
    }

    /**
     * @return Node[]
     */
    private function buildScenarioBody(Scenario $scenario) :array
    {
        $body = [];
        $iExpr = $this->factory->var('I');
        foreach ($scenario->getSteps() as $step) {
            $action = $step->getAction()->getMethodName();
            $body[] = new $this->factory->methodCall($iExpr, $action, $step->getArguments());
        }
        return $body;
    }

    /**
     * @param Scenario $scenario
     * @param Node[] $body
     */
    private function addScenario(Scenario $scenario, array $body) :void
    {
        $scenarioClassMethod = $this->generateScenarioClassMethod($scenario, $body);
        $this->classNode->stmts[] = $scenarioClassMethod;
    }


    /**
     * @param Scenario $scenario
     * @param Node[] $body
     */
    private function updateScenario(Scenario $scenario, array $body) :void
    {
        $visitor = new OverwriteMethodNodeVisitor($scenario->getMethodName(), $body);
        $this->traverseClass($visitor);
    }

    /**
     * @param Scenario $scenario
     * @param Node[] $body
     */
    private function generateScenarioClassMethod(Scenario $scenario, array $body = []) :ClassMethod
    {
        $methodNode = $this->factory->method($scenario->getMethodName())
            ->makePublic()
            ->setReturnType('void')
            ->addParam($this->factory->param('$I')->setType('AcceptanceTester'))
            ->setDocComment($this->getMethodComment())
            ->getNode();
        $methodNode->stmts = $body;
        return $methodNode;
    }

    private function traverseClass(NodeVisitor $visitor) :void
    {
        $traverser = new NodeTraverser();
        $traverser->addVisitor($visitor);
        $traverser->traverse($this->classNode->stmts);
    }

    private function getMethodComment()
    {
        return '/**
        * This method is auto-generated. Do not modify it manually.
        *
        * @Fantestic
        */';
    }
}

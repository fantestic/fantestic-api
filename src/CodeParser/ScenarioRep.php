<?php

declare(strict_types = 1);
namespace App\CodeParser;

use App\CodeParser\Exception\ScenarioNotFoundException;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Comment\Doc;
use phpDocumentor\Reflection\DocBlockFactory;


/**
 * ScenarioRep is responsible for manipulating the AST of a Scenario. It retrieves
 * information and manipulates the AST of a Scenario.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ScenarioRep
{
    private ClassMethod $scenario;

    private bool $readonly = false;

    public function __construct(ClassMethod $scenario)
    {
        $this->scenario = $scenario;
        if (!$this->isFantesticScenario($scenario)) {
            $this->readonly = true;
        }
    }


    public function getMethodName() :string
    {
        return $this->scenario->name->toString();
    }


    private function isFantesticScenario()
    {
        $comments = ($this->scenario->getAttribute('comments', []));
        if (array_key_exists(0, $comments) && $comments[0] instanceof Doc) {
            return $this->commentHasFantesticTag($comments[0]->getReformattedText());
        }
        return false;
    }

    private function commentHasFantesticTag(string $comment)
    {
        $factory  = DocBlockFactory::createInstance();
        $docblock = $factory->create($comment);
        return $docblock->hasTag('fantestic');
    }
}
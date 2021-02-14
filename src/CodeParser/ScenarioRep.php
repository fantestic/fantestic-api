<?php

declare(strict_types = 1);
namespace App\CodeParser;

use PhpParser\Node\Stmt\ClassMethod;


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

    public function __construct(ClassMethod $scenario)
    {
        $this->scenario = $scenario;
    }

    public function getMethodName() :string
    {
        return $this->scenario->name->toString();
    }
}
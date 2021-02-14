<?php

declare(strict_types = 1);

namespace App\CodeParser\Factory;

use App\CodeParser\ScenarioRep;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class ScenarioRepFactory
{
    /**
     * @param string $methodName 
     * @return CestRep 
     */
    public function makeFromClassMethod(ClassMethod $scenario) :ScenarioRep
    {
        return new ScenarioRep($scenario);
    }
}

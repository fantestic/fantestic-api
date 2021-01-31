<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

// Trait only seem to be autoloaded once
// @TODO investigate details and report bug
require_once(__DIR__.'/TestTraits/CestTemplateTrait.php');

use App\CodeParser\CestWrapper;
use App\Entity\Scenario;
use App\Entity\Collection;

use App\Tests\CodeParser\TestTraits\CestTemplateTrait;


class CestWrapperTest extends \Codeception\Test\Unit
{
    use CestTemplateTrait;

    protected function _before() :void
    {
    }

    public function testFindsAlreadyExistingScenarios() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = new Scenario($class->stmts[0]->name->toString(), $this->createCollectionMock());
        $methodNode = $wrapper->findScenario($scenario);
        $this->assertEquals($class->stmts[0], $methodNode);
    }

    public function testWritesScenario() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = $this->createScenarioMock();
        $wrapper->writeScenario($scenario);
        $method = $wrapper->findScenario($scenario);
        $this->assertNotNull($method);
    }


    private function createScenarioMock() :Scenario
    {
        /**
         * @var Scenario
         */
        $s = $this->createMock(Scenario::class);
        return $s;
    }

    private function createCollectionMock() :Collection
    {
        /**
         * @var Collection
         */
        $s = $this->createMock(Collection::class);
        return $s;
    }
}

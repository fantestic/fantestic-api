<?php

declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\Collection;
use App\Entity\Scenario;
use App\Entity\Step;

class ScenarioTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testIdCanHaveANumber() :void
    {
        $this->testValidId('test123');
    }

    public function testCannotStartWithNumber() :void
    {
        $this->testInvalidId('123StartedWithNumber');
    }

    public function testIdCannotHaveASpace() :void
    {
        $this->testInvalidId('function with space');
    }

    public function testIdCannotHaveSpecialCharacter() :void
    {
        $this->testInvalidId('invalid$name');
    }

    public function testAddsStep() :void
    {
        $scenario = new Scenario('test123', $this->getCollection());
        /** @var Step */
        $step = $this->createMock(Step::class);
        $scenario->addStep($step);
        $this->assertSame([$step], $scenario->getSteps());
    }

    public function testConstructorSetsCollection() :void
    {
        $c = $this->getCollection();
        $s = new Scenario('test123', $c);
        $this->assertEquals($c, $s->getCollection());
    }

    private function testValidId(string $id) :void
    {
        $s = new Scenario($id, $this->getCollection());
        $this->assertSame($id, $s->getId());
    }

    private function testInvalidId(string $id) :void
    {
        $this->expectException(\OutOfRangeException::class);
        new Scenario($id, $this->getCollection());
    }

    private function getCollection() :Collection
    {
        /**
         * @var Collection
         */
        $c = $this->createMock(Collection::class);
        return $c;
    }
}
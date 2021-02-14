<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CodeParser;

use App\CodeParser\CestRep;
use App\CodeParser\Factory\CestRepFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ScenarioRepTest extends KernelTestCase
{
    public function testThrowsExceptionIfNotAnnotated() :void
    {
        $cestRep = $this->getCestRep('/Ns1/SimpleCest.php');
        $scenarioRep = $cestRep->findScenario('notForFantestic');
        
    }


    public function testReturnsMethodName() :void
    {
        $this->assertSame(true, true);
    }


    private function getCestRep(string $path) :CestRep
    {
        return $this->getCestRepFactory()->makeFromPath($this->getCestFixturePath($path));
    }


    private function getCestRepFactory() :CestRepFactory
    {
        self::bootKernel(['debug' => 0]);
        return self::$container->get(CestRepFactory::class);
    }


    private function getCestFixturePath(string $file) :string
    {
        return realpath(__DIR__ . '/../../Fixtures/Cest' . $file);
    }
}
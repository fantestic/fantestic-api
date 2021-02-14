<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CodeParser;

use App\CodeParser\Factory\CestRepFactory;
use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use App\CodeParser\ScenarioRep;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CestRepTest extends KernelTestCase
{
    public function testThrowsExceptionOnInvalidPath() :void
    {
        $this->expectException(CestNotFoundException::class);
        $this->getCestRepFactory()->makeFromPath(__DIR__.'/nonExistingDir');
    }


    public function testFindsScenario() :void
    {
        $methodName = 'firstTest';
        $cestRep = $this->getCestRepFactory()->makeFromPath($this->getCestFixturePath('/Ns1/SimpleCest.php'));
        $scenarioRep = $cestRep->findScenario($methodName);
        $this->assertInstanceOf(ScenarioRep::class, $scenarioRep);
        $this->assertSame($methodName, $scenarioRep->getMethodName());
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
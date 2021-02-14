<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CodeParser;

use App\CodeParser\Factory\CestRepFactory;
use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CestRepTest extends KernelTestCase
{
    public function testThrowsExceptionOnInvalidPath() :void
    {
        $this->expectException(CestNotFoundException::class);
        $this->getCestRepFactory()->makeFromPath(__DIR__.'/nonExistingDir');
    }


    public function testThrowsExceptionIfClassNotACest() :void
    {
        $this->expectException(CestNotFoundException::class);
        $a = $this->getCestRepFactory()->makeFromPath(
            //$this->getCestFixturePath('/Invalid/EmptyPhpCest.php')
            $this->getCestFixturePath('/Ns1/SimpleCest.php')
        );
        dump($a->getAst());
    }


    private function getCestRepFactory() :CestRepFactory
    {
        self::bootKernel();
        return self::$container->get(CestRepFactory::class);
    }


    private function getCestFixturePath(string $file) :string
    {
        return realpath(__DIR__ . '/../../Fixtures/Cest' . $file);
    }
}
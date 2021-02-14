<?php

declare(strict_types = 1);
namespace App\Tests\CodeParser;

use App\CodeParser\Factory\CestRepFactory;
use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CestRepTest extends KernelTestCase
{
    public function testThrowsExceptionOnInvalidPath()
    {
        self::bootKernel();
        $this->expectException(CestNotFoundException::class);
        /**
         * @var CestRepFactory
         */
        $f = self::$container->get(CestRepFactory::class);
        $f->makeFromPath('bananas');
    }
}
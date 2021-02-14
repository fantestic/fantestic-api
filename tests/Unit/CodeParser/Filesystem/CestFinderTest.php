<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CodeParser\Filesystem;

use App\CodeParser\Filesystem\Exception\FileNotFoundException;
use App\CodeParser\Factory\CestRepFactory;
use App\CodeParser\CestRep;
use App\CodeParser\Filesystem\CestFinder;
use App\ValueObject\Collection\Id as CollectionId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Finder\Finder;

final class CestFinderTest extends KernelTestCase
{
    public function testThrowsNotFoundExceptionIfInitializedWithInvalidPath() :void
    {
        $this->expectException(FileNotFoundException::class);
        $this->makeCestFinder(Finder::create(), __DIR__ . '/aNonExistingPath');
    }


    public function testFindsCollectionById() :void
    {
        $cestFinder = $this->makeCestFinder(Finder::create(), $this->getCestFixtureBath());
        $id = new CollectionId('Ns1\Simple');
        $cestRep = $cestFinder->findCollectionById($id);
        $this->assertInstanceOf(CestRep::class, $cestRep);
    }


    /**
     * 
     * @param Finder $finder 
     * @param string $basedir 
     * @throws FileNotFoundException 
     * @return CestFinder 
     */
    private function makeCestFinder(Finder $finder, string $basedir) :CestFinder
    {
        self::bootKernel();
        return new CestFinder($finder, $basedir,  self::$container->get(CestRepFactory::class));
    }

    private function getCestFixtureBath()
    {
        return realpath(__DIR__ . '/../../../Fixtures/Cest');
    }
}
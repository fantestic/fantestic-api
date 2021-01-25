<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

use App\Tests\UnitTester;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Finder\Finder;
use App\CodeParser\CestLoader;
use App\Entity\Collection;
use OutOfBoundsException;
use \org\bovigo\vfs\vfsStreamDirectory;

class CestLoaderTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    private vfsStreamDirectory $root;
    private CestLoader $cestLoader;

    protected function _before() :void
    {
        $this->root = vfsStream::setup('root', null, $this->getFilesystemStructure());
        $this->cestLoader = new CestLoader(Finder::create(), $this->root->url());
    }


    public function testLoadsCests() :void
    {
        $expected = [
            new Collection('Test1'),
            new Collection('Test2'),
            new Collection('Test3'),
        ];
        $this->assertEquals($expected, iterator_to_array($this->cestLoader->findCests()));
    }


    public function testFindsCestById() :void
    {
        $collection = $this->cestLoader->findCestById('Test1');
        $this->assertEquals(new Collection('Test1'), $collection);
    }


    public function testThrowsExceptionIfCestIdNotFound() :void
    {
        $this->expectException(OutOfBoundsException::class);
        $this->cestLoader->findCestById('AUnknownCestId');
    }

/*
    public function testCreateCestCreatesCest() :void
    {
        $id = 'NewlyCreated';
        $this->cestLoader->createCest($id);
        $fileExists = file_exists($this->vfsStreamDirectory.PATH_SEPARATOR."{$id}Cest.php");
        $this->assertTrue($fileExists);
    }
    */

    private function getFilesystemStructure() :array
    {
        return  [
            'dir1' => [
                'Nested' => [
                    'Test1Cest.php' => '',
                    'Test2Cest.php' => '',
                    'AnotherFile.php' => '',
                ],
                'Test3Cest.php' => ''
            ],
        ];
    }
}

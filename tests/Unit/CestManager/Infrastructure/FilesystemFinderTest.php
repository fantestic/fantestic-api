<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CestManager\Infrastructure\FilesystemFinder;

final class FilesystemFinderTest extends KernelTestCase
{
    public function testHasFileReturnsTrueIfFileExists() :void
    {
        $found = $this->makeFinder()->hasFile('Ns1/SimpleCest.php');
        $this->assertTrue($found);
    }


    public function testHasFileReturnsFalseIfFileDoesntExist() :void
    {
        $found = $this->makeFinder()->hasFile('Ns1/ThisFileDoesNotExist');
        $this->assertFalse($found);
    }


    public function testListFilesListsFilesRecursively() :void
    {
        $files = $this->makeFinder('/RecursiveList')->listFiles();
        $expected = [
            'Layer1.php',
            'Layer2/Layer2File.php',
        ];
        $this->assertSame($expected, $files);
    }


    private function makeFinder($subdir = '') :FilesystemFinder
    {
        return new FilesystemFinder(
            __DIR__ . '/../../../Fixtures/Cest' . $subdir
        );
    }
}

<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Application\Collection\Id;

use App\CestManager\Domain\Collection\Id;
use App\CestManager\Application\Collection\Id\IdToFilenameConverter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class IdToFilenameConverterTest extends KernelTestCase
{
    public function testConvertsToFilename() :void
    {
        $id = Id::fromNamespace('Ns\File');
        $converter = new IdToFilenameConverter($id);
        $this->assertEquals(
            'Ns' . DIRECTORY_SEPARATOR . 'FileCest.php',
            $converter->convert($id)
        );
    }
}

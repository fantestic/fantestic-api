<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Transformer\Collection;

use App\CestManager\Transformer\Collection\PathToIdTransformer;
use App\CestManager\ValueObject\Collection\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class PathToIdTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $id = Id::fromReadable('Dir/File');
        $t = new PathToIdTransformer('Cest.php');
        $this->assertEquals($id, $t->transform('Dir/FileCest.php'));
    }
}
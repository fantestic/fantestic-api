<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Collection\Transformer;

use App\CestManager\Collection\Transformer\NamespaceToIdTransformer;
use App\CestManager\Collection\ValueObject\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class NamespaceToIdTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $id = Id::fromReadable('Dir/File');
        $t = new NamespaceToIdTransformer('NsPrefix\\');
        $this->assertEquals($id, $t->transform('NsPrefix\Dir\File'));
    }
}

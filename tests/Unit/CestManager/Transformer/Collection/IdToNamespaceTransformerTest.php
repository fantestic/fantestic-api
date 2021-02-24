<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Transformer\Collection;

use App\CestManager\Transformer\Collection\IdToNamespaceTransformer;
use App\CestManager\ValueObject\Collection\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToNamespaceTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $id = Id::fromReadable('SubNs/ClassName');
        $t = new IdToNamespaceTransformer('NsPrefix\\');
        $this->assertEquals('NsPrefix\SubNs\ClassName', $t->transform($id));
    }
}

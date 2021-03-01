<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Collection\Transformer;

use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Collection\ValueObject\Id;
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
        $id = Id::fromString('SubNs-ClassName');
        $t = new IdToNamespaceTransformer('NsPrefix\\', 'Suffix');
        $this->assertEquals('NsPrefix\SubNs\ClassNameSuffix', $t->transform($id));
    }
}

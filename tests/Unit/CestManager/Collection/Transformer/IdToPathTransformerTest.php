<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Collection\Transformer;

use App\CestManager\Collection\Transformer\IdToPathTransformer;
use App\CestManager\Collection\ValueObject\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToPathTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $suffix = 'Cest.php';
        $id = Id::fromReadable('Abc');
        $t = new IdToPathTransformer($suffix);
        $this->assertEquals($id->toReadable().$suffix, $t->transform($id));
    }
}
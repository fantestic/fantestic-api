<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Collection\ValueObject;

use App\CestManager\Collection\ValueObject\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdTest extends KernelTestCase
{
    public function testFromStringDoesNotChangeFromPath() :void
    {
        $path = 'Demo/Value';
        $id = Id::fromString($path);
        $this->assertEquals($path, $id->toReadable());
    }


    public function testFromStringFailsOnInvalidCharacters() :void
    {
        $this->expectException(InvalidIdentifierStringException::class);
        Id::fromString('$invalidPath');
    }
}
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
    public function testFromReadableDoesNotChangeFromPath() :void
    {
        $path = 'Demo/Value';
        $id = Id::fromReadable($path);
        $this->assertEquals($path, $id->toReadable());
    }


    public function testFromReadableFailsOnInvalidCharacters() :void
    {
        $this->expectException(InvalidIdentifierStringException::class);
        Id::fromReadable('$invalidPath');
    }


    public function testFromStringDoesNotChangeFromToString() :void
    {
        $idString = 'RGVtb0Nlc3QucGhw';
        $id = Id::fromString($idString);
        $this->assertEquals($idString, $id->toString());
    }


    public function testFromStringFailsOnInvalidCharacters() :void
    {
        $this->expectException(InvalidIdentifierStringException::class);
        Id::fromString('=invalid-id');
    }
}
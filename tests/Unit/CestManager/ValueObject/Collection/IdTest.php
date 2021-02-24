<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Domain\Scenario;

use App\CestManager\ValueObject\Collection\Id;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CestManager\ValueObject\Exception\InvalidIdentifierStringException;

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
        $path = 'DemoCest.php';
        $id = Id::fromPath($path);
        $this->assertEquals($path, $id->toPath());
    }


    public function testFromPathFailsOnInvalidCharacters() :void
    {
        $this->expectException(InvalidIdentifierStringException::class);
        Id::fromPath('$invalidPath');
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
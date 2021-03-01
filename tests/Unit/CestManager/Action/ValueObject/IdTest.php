<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Action\ValueObject;


use App\CestManager\Action\ValueObject\Id;
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
    public function testThrowsInvalidIdentifierString() :void
    {
        $this->expectException(InvalidIdentifierStringException::class);
        Id::fromString('A invalid identifier');
    }

    public function testDoesNotModifiyAValidIdentifierString() :void
    {
        $idString = 'aValidActionName';
        $id = Id::fromString($idString);
        $this->assertSame($idString, $id->toString());
    }
}
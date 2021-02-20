<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Domain\Scenario;

use App\CestManager\Domain\Scenario\Id;
use App\Language\Php\ReservedKeywords;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class IdTest extends KernelTestCase
{
    public function testFromStringReturnsId() :void
    {
        $id = Id::fromString('Test_\Example::methodName');
        $this->assertInstanceOf(Id::class, $id);
    }


    public function testFromStringRequiresNamespace() :void
    {
        $this->expectException(DomainException::class);
        Id::fromString('::methodName');
    }


    public function testFromStringPreventsDoubleClassSeparator() :void
    {
        $this->expectException(DomainException::class);
        Id::fromString('Ns/Ns::Ns/Ns::methodName');
    }


    public function testFromStringPreventsReservedKeywords() :void
    {
        foreach (ReservedKeywords::forMethod() as $keyword) {
            $this->expectException(DomainException::class);
            Id::fromString('Ns/Ns::'.$keyword);
        }
    }
}
<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Domain\Collection;

use App\CestManager\Domain\Collection\Id;
use App\Language\Php\ReservedKeywords;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class IdTest extends KernelTestCase
{
    public function testFromNamespaceAcceptsUnderscores() :void
    {
        $id = Id::fromNamespace('Test_\Example');
        $this->assertInstanceOf(Id::class, $id);
    }


    public function testFromNamespaceProbibitInvalidCharacters() :void
    {
        // a random list of illegal characters
        $invalidCharacters = '-* #%^+=<>,.?"\'';
        foreach (str_split($invalidCharacters) as $char) {
            $this->expectException(DomainException::class);
            Id::fromNamespace("Test\Te{$char}st");
        }
    }


    public function testFromNamespacePreventsIllegalStartCharacters() :void
    {
        // lowercase & numbers are not allowed to be used
        $invalidStartCharacters = '1\\a';
        foreach (str_split($invalidStartCharacters) as $char) {
            $this->expectException(DomainException::class);
            Id::fromNamespace($char.'Test_\EgNamespace');
        }
    }

    
    public function testFromNamespaceMayNotEndWithSlash() :void
    {
        $this->expectException(DomainException::class);
        Id::fromNamespace('Test_\EgNamespace\\');
    }


    public function testFromNamespacePreventsReservedKeywords() :void
    {
        foreach (ReservedKeywords::forNamespace() as $keyword) {
            $this->expectException(DomainException::class);
            Id::fromNamespace("Test\\{$keyword}\\Test");
        }
    }


    public function testFromNamespacePreventsUppercaseKeywords() :void
    {
        foreach (ReservedKeywords::forNamespace() as $keyword) {
            $keyword = ucfirst($keyword);
            $this->expectException(DomainException::class);
            Id::fromNamespace("Test\\{$keyword}\\Test");
        }
    }
}
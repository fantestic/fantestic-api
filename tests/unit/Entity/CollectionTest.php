<?php

declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\Collection;

class CollectionTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testGettingClassName()
    {
        $id = 'KioskSettings';
        $collection = new Collection($id);
        $this->assertSame($collection->getId(), $id);
    }

    public function testThrowsExceptionWhenSpaceInIdentifier()
    {
        $this->expectException(\OutOfRangeException::class);
       new Collection('Invalid Classname');
    }

    public function testThrowsExceptionWhenSpecialCharIdentifier()
    {
        $this->expectException(\OutOfRangeException::class);
        new Collection('Invalid.Classname');
    }

    public function testThrowsExceptionWhenIdentifierStartsWithNumber()
    {
        $this->expectException(\OutOfRangeException::class);
        new Collection('1Invalid');
    }

    public function testAllowsNumberInLaterPartOfIdentifier()
    {
        $exceptionThrown = false;
        try {
            new Collection('ValidClassName123');
        } catch (\OutOfRangeException $e) {
            $exceptionThrown = true;
        }
        $this->assertFalse($exceptionThrown);
    }
}
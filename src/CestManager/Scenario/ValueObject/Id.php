<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\ValueObject;

use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * Identifier for a Scenario
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    private string $id;


    private function __construct(string $id)
    {
        $this->id = $id;
    }


    public static function fromString(string $readable) :self
    {
        if (1 !== preg_match('/^[a-zA-Z0-9_-]+::[a-z][a-zA-Z0-9_]*$/', $readable)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Readable Scenario Id!', $readable)
            );
        }
        return new self($readable);
    }


    public function toString() :string
    {
        return $this->id;
    }


    public function __toString() :string
    {
        return $this->toString();
    }
}

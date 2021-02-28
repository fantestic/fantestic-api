<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\ValueObject;

use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * Identifier for a Collection
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

    /**
     * 
     * @param string $path 
     * @return Id 
     * @throws InvalidIdentifierStringException 
     */
    public static function fromString(string $path) :self
    {
        if (1 !== preg_match('/^[a-z0-9_-]+$/i', $path)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Collection Path!', $path)
            );
        }
        return new self($path);
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

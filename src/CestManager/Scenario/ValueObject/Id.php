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

    /**
     * 
     * @param string $id 
     * @return Id 
     * @throws InvalidIdentifierStringException 
     */
    public static function fromString(string $id) :self
    {
        if (1 !== preg_match('/^[a-z0-9-_ ]+$/i', $id)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Scenario Identifier!', $id)
            );
        }
        return new self($id);
    }


    public static function fromReadable(string $readable) :self
    {
        if (1 !== preg_match('/^[a-zA-Z0-9_-]+::[a-z][a-zA-Z0-9_]*$/', $readable)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Readable Scenario Id!', $readable)
            );
        }
        $encoded = str_replace(['+','/','='], ['-','_',''], base64_encode($readable));
        return new self($encoded);
    }


    public function toString() :string
    {
        return $this->id;
    }


    public function toReadable() :string
    {
        return base64_decode(str_replace(['-','_'], ['+','/'], $this->id));
    }


    public function __toString() :string
    {
        return $this->toString();
    }
}

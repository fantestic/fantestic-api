<?php

declare(strict_types = 1);
namespace App\CestManager\Action\ValueObject;

use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
/**
 * Identifier for an Action
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


    public static function fromString(string $string) :self
    {
        if (1 !== preg_match('/^[a-z][a-zA-Z0-9_]*$/', $string)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Action Id!', $string)
            );
        }
        return new self($string);
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

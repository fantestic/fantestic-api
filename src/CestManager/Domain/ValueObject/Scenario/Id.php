<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Scenario;

use App\CestManager\Domain\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * Identifier for a Scenario
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    const ID_SEPARATOR = '::';
    private string $id;


    private function __construct(string $id)
    {
        $this->id = $id;
    }


    public static function fromString(string $readable) :self
    {
        if (1 !== preg_match('/^[a-zA-Z0-9_-]+::[a-z][a-zA-Z0-9_]*$/', $readable)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Scenario Id!', $readable)
            );
        }
        return new self($readable);
    }


    public function getCollectionIdRepr() :string
    {
        return substr($this->id, 0, strpos($this->id, self::ID_SEPARATOR));
    }


    public function getMethodName() :string
    {
        return explode(self::ID_SEPARATOR, $this->id)[1];
    }


    public function toString() :string
    {
        return $this->id;
    }


    public function __toString() :string
    {
        return $this->toString();
    }


    public function equals(Id $id) :bool
    {
        return ($id->toString() === $this->toString());
    }
}

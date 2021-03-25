<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Collection;

use App\CestManager\Domain\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * Identifier for a Collection
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    const NS_SEPARATOR = '-';

    public function __construct(
        private string $id
    ) {
        if (1 !== preg_match('/^[a-z0-9_-]+$/i', $id)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Collection Id!', $id)
            );
        }
    }

    public static function fromStringRepr(string $stringRepr) :self
    {
        return new self($stringRepr);
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

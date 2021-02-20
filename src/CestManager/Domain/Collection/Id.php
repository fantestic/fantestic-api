<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Collection;

use DomainException;
use App\Language\Php\ReservedKeywords;

/**
 * Collection Identifier. Maps to a Cest-Class.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    private string $identifier;

    private function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * 
     * @param string $identifier 
     * @return Id 
     * @throws DomainException 
     */
    public static function fromNamespace(string $identifier) :self
    {
        if (preg_match('/^[A-Z_][a-zA-Z0-9_\\\\]*?[a-zA-Z0-9_]$/', $identifier) !== 1) {
            throw new DomainException(
                "The identifier '{$identifier}' is no valid namespace."
            );
        }
        foreach (ReservedKeywords::forNamespace() as $keyword) {
            if (preg_match('/(^|\\\\)'.preg_quote($keyword).'(\\\\|$)/i', $identifier) === 1) {
                throw new DomainException(
                    "The namespace '{$identifier}' entails the reserved keyword '{$keyword}'"
                );
            }
        }
        return new self($identifier);
    }


    /**
     * 
     * @return string 
     */
    public function toString() :string
    {
        return $this->identifier;
    }
}

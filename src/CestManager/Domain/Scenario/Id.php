<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Scenario;

use DomainException;
use App\CestManager\Domain\Collection\Id as CollectionId;
use App\Language\Php\ReservedKeywords;
use Exception;

/**
 * Scenario Identifier. Maps to a Cest-Method.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    private Collectionid $collectionId;

    private string $methodName;

    const CLASS_METHOD_SEPARATOR = '::';

    private function __construct(
        CollectionId $collectionId,
        string $methodName
    ) {
        $this->collectionId = $collectionId;
        $this->setMethodName($methodName);
    }

    /**
     * 
     * @param string $identifier 
     * @return Id 
     * @throws DomainException 
     */
    public static function fromString(string $identifier) :self
    {
        $splitIdentifier = explode(self::CLASS_METHOD_SEPARATOR, $identifier);
        if (!is_array($splitIdentifier) || count($splitIdentifier) !== 2) {
            throw new DomainException(
                "'{$identifier}' is not a valid ScenarioId Format!"
            );
        }
        return new self(
            CollectionId::fromNamespace($splitIdentifier[0]),
            $splitIdentifier[1]
        );
    }

    
    public function toString() :string
    {
        return $this->collectionId->toString() .
            self::CLASS_METHOD_SEPARATOR .
            $this->methodName;
    }


    private function setMethodName(string $methodName) :void
    {
        if (preg_match('/^[a-z_][A-Za-z0-9_]*$/', $methodName) !== 1) {
            throw new DomainException(
                "'{$methodName}' must be a valid function-name."
            );
        }
        if (in_array($methodName, ReservedKeywords::forMethod())) {
            throw new DomainException(
                "'{$methodName}' is a reserved method name."
            );
        }
        $this->methodName = $methodName;
    }
}

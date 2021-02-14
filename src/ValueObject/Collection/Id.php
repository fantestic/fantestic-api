<?php

declare(strict_types = 1);

namespace App\ValueObject\Collection;

use DomainException;

class Id
{
    private string $identifier;

    /**
     * 
     * @param string $identifier 
     * @throws \DomainException
     * @return void 
     */
    public function __construct(string $identifier)
    {
        $this->setIdentifier($identifier);
    }

    public function toString() :string
    {
        return $this->identifier;
    }

    public function __toString() :string
    {
        return $this->toString();
    }

    /**
     * 
     * @param string $identifier 
     * @return void 
     * @throws DomainException
     */
    private function setIdentifier(string $identifier) :void
    {
        //if (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\\\\]*[a-zA-Z0-9_\x7f-\xff]$/', $identifier)) {
        //    throw new \DomainException("{$identifier} is not considered a valid Collection Identifier!");
        //}
        $this->identifier = $identifier;
    }
}
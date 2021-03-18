<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Collection;

/**
 * A Prefix which are prepended to Cests. It's generally the base namespace where
 * Cests reside in.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Prefix
{
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }


    public function toString() :string
    {
        return $this->prefix;
    }


    public function __toString() :string
    {
        return $this->toString();
    }
}

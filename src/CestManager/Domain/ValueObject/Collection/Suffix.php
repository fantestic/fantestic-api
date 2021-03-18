<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Collection;

/**
 * A suffix which is appended to Cests. Most commonly it's "Cest"
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Suffix
{
    private string $suffix;

    public function __construct(string $suffix)
    {
        $this->suffix = $suffix;
    }


    public function toString() :string
    {
        return $this->suffix;
    }


    public function __toString() :string
    {
        return $this->toString();
    }
}

<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Scenario;

use DomainException;

/**
 * ValueObject for the checksum of a Scenario.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Checksum
{
    private string $checksum;

    /**
     * 
     * @param string $checksum
     * @return void 
     * @throws DomainException
     */
    private function __construct(string $checksum)
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $checksum) !== 1) {
            throw new DomainException(
                "The checksum '{$checksum}' is not a valid md5 hash."
            );
        }
        $this->checksum = $checksum;
    }


    /**
     * 
     * @param string $checksum 
     * @return Id 
     * @throws DomainException 
     */
    public static function fromString(string $checksum) :self
    {
        return new self($checksum);
    }


    public function toString() :string
    {
        return $this->checksum;
    }
}
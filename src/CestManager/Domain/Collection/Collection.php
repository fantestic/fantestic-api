<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Collection;

/**
 * A collection of Scenarios.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Collection
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

}

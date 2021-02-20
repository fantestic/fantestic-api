<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Collection;


/**
 * Collection Repository
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface Repository
{
    /**
     * Find a Collection by its id. Returns null if Collection cannot be found.
     * 
     * @param Id $id 
     * @return Collection 
     */
    public function findById(Id $id) :?Collection;
}

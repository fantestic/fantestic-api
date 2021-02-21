<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Scenario;


/**
 * Scenario Repository
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface Repository
{
    /**
     * Find a Scenario by its id. Returns null if Scenario cannot be found.
     * 
     * @param Id $id 
     * @return Scenario 
     */
    public function findById(Id $id) :?Scenario;
}

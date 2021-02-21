<?php

declare(strict_types = 1);

namespace App\CestManager\Domain\Scenario;

/**
 * 
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Scenario
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

}

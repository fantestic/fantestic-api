<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\ValueObject;

use App\CestManager\Action\Entity\Action;

/**
 * A single step inside a scenario. Composed of an Action and a position
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Step
{
    private int $position;

    private Action $action;

    private array $parameters;

    private function getPosition() :int
    {
        return $this->position;
    }


    private function getAction() :Action
    {
        return $this->action;
    }
}
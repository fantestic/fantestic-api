<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\ValueObject;

use App\CestManager\Action\Entity\Action;
use Fantestic\CestManager\Contract\StepInterface;

/**
 * A single step inside a scenario. Composed of an Action and a position
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Step implements StepInterface
{
    private int $position;

    private Action $action;

    private array $arguments;

    public function getArguments(): iterable
    {
        return $this->arguments;
    }

    public function getPosition() :int
    {
        return $this->position;
    }


    public function getAction() :Action
    {
        return $this->action;
    }
}
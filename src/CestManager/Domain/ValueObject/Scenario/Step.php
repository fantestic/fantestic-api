<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Scenario;

use App\CestManager\Domain\Entity\Action;
use Fantestic\CestManager\Contract\StepInterface;
use Fantestic\CestManager\Dto\Step as StepDto;

/**
 * A single step inside a scenario. Composed of an Action and a position
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Step implements StepInterface
{
    public function __construct(
        private int $position,
        private Action $action,
        private iterable $arguments
    ) { }

    public static function fromDto(StepDto $stepDto) :Step
    {
        $arguments = [];
        foreach ($stepDto->getArguments() as $pos => $argument) {
            $arguments[] = Argument::fromDto($argument, $pos);
        }
        $instance = new self(
            $stepDto->getPosition(),
            Action::fromDto($stepDto->getAction()),
            $arguments
        );
        return $instance;
    }

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

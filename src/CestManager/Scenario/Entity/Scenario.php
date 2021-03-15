<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Entity;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Scenario\ValueObject\Id;
use App\CestManager\Scenario\ValueObject\Step;
use Fantestic\CestManager\Contract\ScenarioInterface;
use Fantestic\CestManager\Dto\Scenario as ScenarioDto;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Scenario implements ScenarioInterface
{
    private Id $id;

    /**
     * @var Collection
     */
    private ?Collection $collection = null;

    /**
     * @var Step[]
     */
    private array $steps = [];


    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public static function fromDto(ScenarioDto $dto, CollectionId $collectionId) :Scenario
    {
        $id = Id::fromString(
            $collectionId->toString() . Id::ID_SEPARATOR . $dto->getMethodName()
        );
        $instance = new self($id);
        foreach ($dto->getSteps() as $step) {
            $instance->addStep(Step::fromDto($step));
        }
        return $instance;
    }

    public function getMethodName(): string
    {
        return $this->id->getMethodName();
    }

    public function getId() :Id
    {
        return $this->id;
    }


    public function setId(Id $id) :self
    {
        $this->id = $id;
        return $this;
    }

    public function getCollection() :?Collection
    {
        return $this->collection;
    }

    /**
     * 
     * @return iterable|Step[]
     */
    public function getSteps() :iterable
    {
        return $this->steps;
    }

    public function addStep(Step $step) :self
    {
        $this->steps[] = $step;
        return $this;
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Entity;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Scenario\ValueObject\Id;
use App\CestManager\Scenario\ValueObject\Step;
use Fantestic\CestManager\Contract\ScenarioInterface;

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
     * 
     * @var Step[]
     */
    private array $steps;


    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getMethodName(): string
    {
        return $this->id->getMethodName();
    }


    public function getId() :Id
    {
        return $this->id;
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
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Entity;

use App\CestManager\Domain\Entity\Scenario;
use App\CestManager\Domain\ValueObject\Collection\Id;
use Fantestic\CestManager\Contract\CollectionInterface;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Collection implements CollectionInterface
{
    private Id $id;

    /**
     * 
     * @var Scenario[]
     */
    private $scenarios = [];

    public function __construct(Id $id)
    {
        $this->id = $id;
    }


    public function getClassname(): string
    {
        return $this->id->getClassname();
    }


    public function getNamespace(): string
    {
        return $this->id->getNamespace();
    }


    public function getSubpath(): string
    {
        return $this->id->getSubpath();
    }


    public function getFullyQualifiedClassname(): string
    {
        return $this->id->getFullyQualifiedClassname();
    }


    public function getId() :Id
    {
        return $this->id;
    }


    /**
     * 
     * @return iterable|Scenario[]
     */
    public function getScenarios() :iterable
    {
        return $this->scenarios;
    }


    public function addScenario(Scenario $scenario) :self
    {
        $this->scenarios[] = $scenario;
        return $this;
    }


    public function setScenarios(iterable $scenarios) :self
    {
        $this->scenarios = [];
        foreach ($scenarios as $scenario) {
            $this->scenarios[] = $scenario;
        }
        return $this;
    }
}

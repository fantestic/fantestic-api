<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Entity;

use App\CestManager\Scenario\Entity\Scenario;
use App\CestManager\Collection\ValueObject\Id;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Collection
{
    private Id $id;

    /**
     * 
     * @var Scenario[]
     */
    private $scenarios = [];

    public function __construct(Id $id, array $scenarios = [])
    {
        $this->id = $id;
        $this->scenarios = $scenarios;
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
}

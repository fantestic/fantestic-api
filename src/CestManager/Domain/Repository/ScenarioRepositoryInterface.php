<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Repository;

use App\CestManager\Domain\Entity\Scenario;
use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;

/**
 * Repository to locate Scenarios
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface ScenarioRepositoryInterface
{
    public function find(ScenarioId $id) :?Scenario;
}

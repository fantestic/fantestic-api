<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Scenario\Entity\Scenario;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Collection\Transformer\NamespaceToIdTransformer;
use Fantestic\CestManager\CestReader\ReflectionCestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ScenarioRepository
{
    public function __construct(
        private ReflectionCestReader $cestReader,
        private IdToNamespaceTransformer $idToNamespaceTransformer,
        private NamespaceToIdTransformer $namespaceToIdTransformer
    ) {}


    /**
     * Returns a list of all Scenarios inside a Collection
     * 
     * @return iterable|Scenario[] 
     */
    public function findAllForCollection(CollectionId $id) :?iterable
    {
        $classname = $this->idToNamespaceTransformer->transform($id);
        try {
            $scenarios = [];
            foreach ($this->cestReader->getScenarioNames($classname) as $scenarioName) {
                $scenarios[] = new Scenario(new ScenarioId('@TODO'));
            }
        } catch (ClassNotFoundException $e) {
            return null;
        }
    }
}

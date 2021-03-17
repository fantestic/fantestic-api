<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario;

use App\CestManager\Collection\Adapter\FantesticCollection;
use App\CestManager\Collection\Adapter\FantesticCollectionFactory;
use App\CestManager\Collection\CollectionRepository;
use App\CestManager\Scenario\Entity\Scenario;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
use App\CestManager\Scenario\Transformer\ScenarioIdToCollectionIdTransformer;
use App\Cestmanager\Scenario\Transformer\IdToCollectionIdTransformer;
use App\Cestmanager\Collection\Transformer\CollectionToDtoTransformer;
use Fantestic\CestManager\CestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;
use InvalidArgumentException;

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
        private CestReader $cestReader,
        private CollectionRepository $collectionRepository,
        private ScenarioIdToCollectionIdTransformer $scenarioIdToCollectionIdTransformer,
        private FantesticCollectionFactory $fantesticCollectionFactory
    ) {}


    /**
     * 
     * @param ScenarioId $id 
     * @return null|Scenario
     * @throws InvalidArgumentException
     * @throws InvalidIdentifierStringException
     */
    public function find(ScenarioId $id) :?Scenario
    {
        try {
            $collection = $this->collectionRepository->find(
                $this->scenarioIdToCollectionIdTransformer->transform($id)
            );
            if (is_null($collection)) {
                return null;
            }
            $scenarioDto = $this->cestReader->getScenario(
                $this->fantesticCollectionFactory->make($collection),
                new Scenario($id)
            );
            if (is_null($scenarioDto)) {
                return null;
            }
            return Scenario::fromDto($scenarioDto, $collection->getId());
        } catch (ClassNotFoundException $e) {
            return null;
        }
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\Repository;

use App\CestManager\Infra\Repository\CollectionRepository;
use App\CestManager\Domain\Entity\Scenario;
use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use App\CestManager\Domain\Exception\ValueObject\InvalidIdentifierStringException;
use App\CestManager\Domain\Repository\ScenarioRepositoryInterface;
use App\CestManager\Infra\Factory\CollectionIdFactory;
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
class ScenarioRepository implements ScenarioRepositoryInterface
{
    public function __construct(
        private CestReader $cestReader,
        private CollectionRepository $collectionRepository,
        private CollectionIdFactory $collectionIdFactory
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
                $this->collectionIdFactory->fromScenarioId($id)
            );
            if (is_null($collection)) {
                return null;
            }
            $scenarioDto = $this->cestReader->getScenario(
                $collection,
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

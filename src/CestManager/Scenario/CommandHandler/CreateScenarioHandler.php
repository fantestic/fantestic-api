<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\CommandHandler;

use App\CestManager\Collection\Adapter\FantesticCollectionFactory;
use Fantestic\CestManager\CestManipulator;
use App\CestManager\Collection\Command\CreateCollection;
use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Scenario\Command\CreateScenario;
use App\CestManager\Scenario\Transformer\IdToCollectionIdTransformer;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Scenario.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CreateScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestManipulator $cestManipulator,
        private IdToCollectionIdTransformer $idToCollectionIdTransformer,
        private FantesticCollectionFactory $fantesticCollectionFactory
    ) { }


    public function __invoke(CreateScenario $createScenario) :void
    {
        try {
            $collectionEntity = new Collection(
                $this->idToCollectionIdTransformer->transform(
                    $createScenario->getScenario()->getId()
                )
            );
            $collectionAdapter = $this->fantesticCollectionFactory->make(
                $collectionEntity
            );
            $this->cestManipulator->createScenario(
                $collectionAdapter,
                $createScenario->getScenario()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}

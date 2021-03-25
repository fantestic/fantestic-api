<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\Command\UpdateScenario;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use App\CestManager\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Fantestic\CestManager\CestWriter;
use Fantestic\CestManager\CestReader;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to update a Scenario.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class UpdateScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CestReader $cestReader,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }


    public function __invoke(UpdateScenario $updateScenario) :void
    {
        try {
            $collection = new Collection(
                CollectionId::fromStringRepr(
                    $updateScenario->getScenario()->getId()->getCollectionIdRepr()
                )
            );
            $collectionAdapter = $this->collectionAdapterFactory->makeFromCollection($collection);
            if (!$this->cestReader->hasScenario(
                $collectionAdapter,
                $updateScenario->getScenario())
            ) {
                $this->cestWriter->createScenario(
                    $collectionAdapter,
                    $updateScenario->getScenario()
                );
            } else {
                $this->cestWriter->updateScenario(
                    $collectionAdapter,
                    $updateScenario->getScenario()
                );
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use App\CestManager\Domain\Command\CreateScenario;
use App\CestManager\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Fantestic\CestManager\CestWriter;
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
        private CestWriter $cestWriter,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }


    public function __invoke(CreateScenario $createScenario) :void
    {
        try {
            $collectionId = CollectionId::fromStringRepr(
                $createScenario->getScenario()->getId()->getCollectionIdRepr()
            );
            $this->cestWriter->createScenario(
                $this->collectionAdapterFactory->makeFromCollectionId($collectionId),
                $createScenario->getScenario()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}

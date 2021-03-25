<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use Fantestic\CestManager\CestWriter;
use App\CestManager\Domain\Command\RemoveScenario;
use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use App\CestManager\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Scenario.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class RemoveScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CollectionAdapterFactory $fantesticBridge
    ) { }


    public function __invoke(RemoveScenario $removeScenario) :void
    {
        try {
            $scenario = $removeScenario->getScenario();
            $collectionId = CollectionId::fromStringRepr($scenario->getId()->getCollectionIdRepr());
            
            $this->cestWriter->removeScenario(
                $this->collectionAdapterFactory->makeFromCollectionId($collectionId),
                $scenario
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}

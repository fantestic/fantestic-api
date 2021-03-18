<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\Command\UpdateScenario;
use App\CestManager\Infra\Factory\CollectionIdFactory;
use Exception;
use Fantestic\CestManager\CestWriter;
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
        private CollectionIdFactory $collectionIdFactory
    ) { }


    public function __invoke(UpdateScenario $updateScenario) :void
    {
        try {
            $collectionEntity = new Collection(
                $this->collectionIdFactory->fromScenarioId(
                    $updateScenario->getScenario()->getId()
                )
            );
            $this->cestWriter->updateScenario(
                $collectionEntity,
                $updateScenario->getScenario()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}

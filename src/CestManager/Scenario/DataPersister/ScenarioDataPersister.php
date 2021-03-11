<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\DataPersister;

use App\CestManager\Scenario\Command\RemoveScenario;
use App\CestManager\Scenario\Command\CreateScenario;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\CestManager\Scenario\Entity\Scenario;
use Symfony\Component\Messenger\MessageBusInterface;


/**
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class ScenarioDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}


    public function supports($data, array $context = []): bool
    { 
        return $data instanceof Scenario;
    }


    /**
     * 
     * @param Scenario $data 
     * @param array $context 
     * @return void 
     */
    public function persist($data, array $context = []) :void
    {
        if ('post' === $context['collection_operation_name']) {
            $this->bus->dispatch(new CreateScenario($data));
        }
    }


    public function remove($data, array $context = []) :void
    {
        $this->bus->dispatch(new RemoveScenario($data));
    }
}

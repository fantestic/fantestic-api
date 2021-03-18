<?php

declare(strict_types = 1);
namespace App\CestManager\App\DataPersister;

use App\CestManager\Domain\Command\RemoveScenario;
use App\CestManager\Domain\Command\CreateScenario;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\CestManager\Domain\Command\UpdateScenario;
use App\CestManager\Domain\Entity\Scenario;
use App\CestManager\Domain\ValueObject\Scenario\Step;
use App\CestManager\Domain\Entity\Action;
use App\CestManager\Domain\ValueObject\Action\Id as ActionId;
use App\CestManager\Domain\ValueObject\Scenario\Argument;
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
        $operation = $context['item_operation_name'] ?? $context['collection_operation_name'];
        if ('put' === $operation) {
            // @TODO Fix to use $data
            $rawContent = (json_decode(file_get_contents("php://input"), true));

            $steps = [];
            foreach ($rawContent['steps'] as $step) {
                $arguments = [];
                foreach ($step['arguments'] as $argument) {
                    $arguments[] = new Argument($argument['position'], $argument['value']);
                }
                $steps[] = new Step(
                    $step['position'],
                    new Action(ActionId::fromString($step['action']['id']), $step['action']['readable'], []),
                    $arguments
                );
            }
            $data->setSteps($steps);
            $this->bus->dispatch(new UpdateScenario($data));
        } elseif ('post' === $operation) {
            $this->bus->dispatch(new CreateScenario($data));
        }
    }


    public function remove($data, array $context = []) :void
    {
        $this->bus->dispatch(new RemoveScenario($data));
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use Fantestic\CestManager\CestWriter;
use App\CestManager\Domain\Command\RemoveScenario;
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
        private CestWriter $cestWriter
    ) { }


    public function __invoke(RemoveScenario $removeScenario) :void
    {
        try {
            throw new Exception('Not implemented');
        } catch (Exception $e) {
            throw $e;
        }
    }
}

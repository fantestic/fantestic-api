<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use Fantestic\CestManager\CestWriter;
use App\CestManager\Domain\Command\CreateCollection;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Command.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CreateCollectionHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter
    ) { }


    public function __invoke(CreateCollection $createCollection) :void
    {
        try {
            $this->cestWriter->createCest($createCollection->getCollection());
        } catch (Exception $e) {
            throw $e;
        }
    }
}

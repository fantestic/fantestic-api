<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\CommandHandler;

use App\CestManager\Collection\Adapter\FantesticCollectionFactory;
use Fantestic\CestManager\CestWriter;
use App\CestManager\Collection\Command\CreateCollection;
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
        private CestWriter $cestWriter,
        private FantesticCollectionFactory $fantesticCollectionFactory
    ) { }


    public function __invoke(CreateCollection $createCollection) :void
    {
        try {
            $collection = $this->fantesticCollectionFactory->make(
                $createCollection->getCollection()
            );
            $this->cestWriter->createCest($collection);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\CommandHandler;

use Fantestic\CestManager\Finder;
use App\CestManager\Domain\Command\RemoveCollection;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler for RemoveCollection commands. Physically deletes a
 * Command-File from the system.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class RemoveCollectionHandler implements MessageHandlerInterface
{
    public function __construct(
        private Finder $finder
    ) { }


    public function __invoke(RemoveCollection $removeCollection) :void
    {
        $this->finder->removeFile($removeCollection->getCollectionId()->getSubpath());
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\DataPersister;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\Command\RemoveCollection;
use App\CestManager\Collection\Command\CreateCollection;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Messenger\MessageBusInterface;


/**
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}


    public function supports($data, array $context = []): bool
    { 
        return $data instanceof Collection;
    }


    /**
     * 
     * @param Collection $data 
     * @param array $context 
     * @return void 
     */
    public function persist($data, array $context = []) :void
    {
        if ('post' === $context['collection_operation_name']) {
            $this->bus->dispatch(new CreateCollection($data));
        }
    }


    public function remove($data, array $context = []) :void
    {
        $this->bus->dispatch(new RemoveCollection($data));
    }
}

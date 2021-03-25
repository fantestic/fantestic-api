<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\Repository;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\Repository\CollectionRepositoryInterface;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use App\CestManager\Infra\FantesticBridge\CollectionAdapter;
use App\CestManager\Infra\FantesticBridge\CollectionAdapterFactory;
use App\CestManager\Infra\FantesticBridge\CollectionIdFactory;
use Fantestic\CestManager\Finder;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CollectionRepository implements CollectionRepositoryInterface
{
    public function __construct(
        private Finder $finder,
        private CollectionIdFactory $collectionIdFactory,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) {}


    /**
     * Returns a list of all existing Collections
     * 
     * @return iterable|Collection[] 
     */
    public function findAll() :iterable
    {
        foreach ($this->finder->listFiles() as $path) {
            yield new Collection(
                $this->collectionIdFactory->makeFromSubpath($path)
            );
        }
    }


    /**
     * Finds a collection or returns null if the collection cant be found.
     * 
     * @param Id $id 
     * @return null|Collection 
     */
    public function find(CollectionId $id) :?Collection
    {
        $adapter = $this->collectionAdapterFactory->makeFromCollectionId($id);
        if ($this->finder->hasFile($adapter->getSubpath())) {
            return new Collection($id);
        } else {
            return null;
        }
    }
}

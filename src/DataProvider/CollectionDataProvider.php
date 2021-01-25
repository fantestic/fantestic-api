<?php

declare(strict_types = 1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Collection;
use App\CodeParser\CestLoader;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use OutOfBoundsException;

/**
 * DataProvider Api, providing access to Cest Files.
 * Utilizes CestLoader to walk a directory and select all Cest-files.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 */
final class CollectionDataProvider implements CollectionDataProviderInterface, ItemDataProviderInterface
{
    private CestLoader $cestLoader;


    public function __construct(CestLoader $cestLoader)
    {
        $this->cestLoader = $cestLoader;
    }


    public function supports(string $resourceClass) :bool
    {
        return (Collection::class === $resourceClass);
    }


    /**
     * Retrieves a list of Cests from a directory
     * 
     * @throws ResourceClassNotSupportedException
     * @return iterable
     */
    public function getCollection(string $resourceClass, ?string $operationName = null) :iterable
    {
        if (!$this->supports($resourceClass)) {
            throw new ResourceClassNotSupportedException();
        }
        return $this->cestLoader->findCests();
    }


    /**
     * Retrieves a single Cest from the filesystem
     * 
     * @throws ResourceClassNotSupportedException
     * @return Collection
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []) :?Collection
    {
        if (!$this->supports($resourceClass)) {
            throw new ResourceClassNotSupportedException();
        }
        try {
            return $this->cestLoader->findCestById($id);
        } catch(OutOfBoundsException $e) {
            return null;
        }
    }
}

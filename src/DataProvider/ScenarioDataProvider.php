<?php

declare(strict_types = 1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use App\Entity\Scenario;
use App\CodeParser\CestLoader;


/**
 * DataProvider to access Scenarios inside Cest-files.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class ScenarioDataProvider implements CollectionDataProviderInterface, ItemDataProviderInterface
{
    private CestLoader $cestLoader;

    public function __construct(CestLoader $cestLoader)
    {
        $this->cestLoader = $cestLoader;
    }


    public function supports(string $resourceClass) :bool
    {
        return (Scenario::class === $resourceClass);
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
        return [
            new Scenario('example1'),
            new Scenario('example2'),
            new Scenario('example3'),
        ];
        // HAS TO BE SUBRESOURCE
        //$cest = $this->cestLoader->findCestById($resourceClass->);
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
        } catch(\OutOfBoundsException $e) {
            return null;
        }
    }
}

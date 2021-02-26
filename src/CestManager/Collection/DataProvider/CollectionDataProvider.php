<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\DataProvider;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\CollectionRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\CestManager\Collection\ValueObject\Id;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class CollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private CollectionRepository $collectionRepository
    ) {}


    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Collection::class === $resourceClass;
    }


    /**
     * 
     * @param string $resourceClass 
     * @param string|null $operationName 
     * @param array $context 
     * @return iterable|Collection[]
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return $this->collectionRepository->findAll();
    }
}

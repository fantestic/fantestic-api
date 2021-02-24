<?php

declare(strict_types = 1);
namespace App\CestManager\DataProvider\Collection;

use App\CestManager\Entity\Collection;
use App\CestManager\Repository\CollectionRepository;
use App\CestManager\ValueObject\Collection\Id;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\CestManager\ValueObject\Exception\InvalidIdentifierStringException;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class ItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private CollectionRepository $collectionRepository
    ) {}

    /**
     * @inheritdoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Collection::class === $resourceClass;
    }


    /**
     * @inheritdoc
     */
    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []) :Collection
    {
        return $this->collectionRepository->find(Id::fromString($id));
    }
}

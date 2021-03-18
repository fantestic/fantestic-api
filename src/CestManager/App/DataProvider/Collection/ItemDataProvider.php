<?php

declare(strict_types = 1);
namespace App\CestManager\App\DataProvider\Collection;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Infra\Repository\CollectionRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\CestManager\Infra\Factory\CollectionIdFactory;

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
        private CollectionRepository $collectionRepository,
        private CollectionIdFactory $collectionIdFactory
    ) {}


    /**
     * @inheritdoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return (Collection::class === $resourceClass);
    }


    /**
     * @inheritdoc
     */
    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []) :?Collection
    {
        return $this->collectionRepository->find(
            $this->collectionIdFactory->fromStringRepr($id)
        );
    }
}

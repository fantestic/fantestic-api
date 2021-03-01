<?php

declare(strict_types = 1);
namespace App\CestManager\Action\DataProvider;

use App\CestManager\Action\Entity\Action;
use App\CestManager\Action\ActionRepository;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;


/**
 * DataProvider to load Actions into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class CollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private ActionRepository $actionRepository
    ) {}


    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Action::class === $resourceClass;
    }


    /**
     * 
     * @param string $resourceClass 
     * @param string|null $operationName 
     * @param array $context 
     * @return iterable|Action[]
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return $this->actionRepository->findAll();
    }
}

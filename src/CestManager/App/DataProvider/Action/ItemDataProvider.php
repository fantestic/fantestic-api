<?php

declare(strict_types = 1);
namespace App\CestManager\App\DataProvider\Action;

use App\CestManager\Domain\Entity\Action;
use App\CestManager\Infra\Repository\ActionRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;



/**
 * DataProvider to load Actions
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class ItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private ActionRepository $actionRepository
    ) { }


    /**
     * @inheritdoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Action::class === $resourceClass;
    }


    /**
     * @inheritdoc
     */
    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []) :?Action
    {
        return $this->actionRepository->find($id);
    }
}

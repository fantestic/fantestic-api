<?php

declare(strict_types = 1);
namespace App\CestManager\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class CollectionDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{

    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = [])
    {
        
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool { }
}

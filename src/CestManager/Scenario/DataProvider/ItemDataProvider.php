<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\DataProvider;

use App\CestManager\Scenario\Entity\Scenario;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\CestManager\Scenario\ScenarioRepository;
use App\CestManager\Scenario\ValueObject\Id;
use Exception;

/**
 * DataProvider to load Scenarios into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class ItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private ScenarioRepository $scenarioRepository
    ) { }


    /**
     * @inheritdoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Scenario::class === $resourceClass;
    }


    /**
     * @inheritdoc
     */
    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []) :?Scenario
    {
        return $this->scenarioRepository->find(Id::fromString($id));
    }
}

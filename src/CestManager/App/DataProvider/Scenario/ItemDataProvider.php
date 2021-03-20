<?php

declare(strict_types = 1);
namespace App\CestManager\App\DataProvider\Scenario;

use App\CestManager\Domain\Entity\Scenario;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\CestManager\Infra\Repository\ScenarioRepository;
use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use Fantestic\CestManager\Exception\MethodNotFoundException;

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
        try {
            return $this->scenarioRepository->find(ScenarioId::fromString($id));
        } catch (MethodNotFoundException $e) {
            return null;
        }
    }
}

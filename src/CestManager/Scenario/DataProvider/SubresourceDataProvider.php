<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\DataProvider;

use App\CestManager\Collection\CollectionRepository;
use App\CestManager\Scenario\Transformer\IdToCollectionIdTransformer;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Scenario\Entity\Scenario;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use Fantestic\CestManager\CestReader\ReflectionCestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class SubresourceDataProvider implements RestrictedDataProviderInterface, SubresourceDataProviderInterface
{
    public function __construct(
        private IdToCollectionIdTransformer $idToCollectionIdTransformer,
        private CollectionRepository $collectionRepository,
        private ReflectionCestReader $cestReader,
        private IdToNamespaceTransformer $idToNamespaceTransformer
    ) { }


    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Scenario::class === $resourceClass;
    }


    /**
     * 
     * @param string $resourceClass 
     * @param array $identifiers 
     * @param array $context 
     * @param string|null $operationName 
     * @return iterable|Scenario[]
     * @throws ClassNotFoundException
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, ?string $operationName = null) :?iterable
    {
        $collectionId = CollectionId::fromString($identifiers['id']['id']);
        try {
            $collectionId = CollectionId::fromString($identifiers['id']['id']);
            // try and load Collection prior to ensure we have a valid Collection
            $collection = $this->collectionRepository->find($collectionId);
            if (is_null($collection)) {
                return null;
            }
            $names = $this->cestReader->getScenarioNames(
                $this->idToNamespaceTransformer->transform($collectionId)
            );
            
            foreach ($names as $name) {
                // dependency how to build id is hidden here
                yield new Scenario(ScenarioId::fromString(
                    $collectionId->toString().ScenarioId::ID_SEPARATOR.$name
                ));
            }
        } catch (InvalidIdentifierStringException $e) {
            return null;
        } catch (ClassNotFoundException $e) {
            throw $e;
        }
    }
}




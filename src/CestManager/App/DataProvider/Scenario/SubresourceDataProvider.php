<?php

declare(strict_types = 1);
namespace App\CestManager\App\DataProvider\Scenario;

use App\CestManager\Infra\Repository\CollectionRepository;
use App\CestManager\Domain\Exception\ValueObject\InvalidIdentifierStringException;
use App\CestManager\Domain\Entity\Scenario;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use Fantestic\CestManager\CestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;
use LogicException;
use Fantestic\CestManager\Exception\UnprocessableScenarioException;
use App\CestManager\Infra\Factory\CollectionIdFactory;

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
        private CollectionRepository $collectionRepository,
        private CestReader $cestReader,
        private CollectionIdFactory $collectionIdFactory
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
     * @throws LogicException
     * @throws UnprocessableScenarioException
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, ?string $operationName = null) :?iterable
    {
        $collectionId = $this->collectionIdFactory->fromStringRepr($identifiers['id']['id']);
        try {
            $collectionDto = $this->cestReader->getCollection(
                $collectionId->getFullyQualifiedClassname()
            );
            foreach ($collectionDto->getScenarios() as $scenario) {
                yield Scenario::fromDto($scenario, $collectionId);
            }
        } catch (InvalidIdentifierStringException $e) {
            return null;
        } catch (ClassNotFoundException | LogicException | UnprocessableScenarioException $e) {
            throw $e;
        }
    }
}

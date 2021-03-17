<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Transformer;

use App\CestManager\Contract\TransformerInterface;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use InvalidArgumentException;

/**
 * Transforms a CestPath to a CollectionId
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class ScenarioIdToCollectionIdTransformer implements TransformerInterface
{

    /**
     * Transform a ScenarioId to a CollectionId
     * @param ScenarioId $scenarioId 
     * @return CollectionId 
     */
    public function transform($scenarioId) :CollectionId
    {
        if (!$scenarioId instanceof ScenarioId) {
            throw new InvalidArgumentException(
                sprintf('Can only transform ScenarioIds, %s received.', gettype($scenarioId))
            );
        }
        $collectionIdAsString = explode(ScenarioId::ID_SEPARATOR, $scenarioId->toString())[0];

        return CollectionId::fromString($collectionIdAsString);
    }
}

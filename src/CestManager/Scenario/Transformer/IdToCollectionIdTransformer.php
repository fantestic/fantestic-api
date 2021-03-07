<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Transformer;

use App\CestManager\Contract\TransformerInterface;
use App\CestManager\Scenario\Entity\Scenario;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use InvalidArgumentException;

/**
 * Transforms a CollectionId to a PHP-Namespace
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToCollectionIdTransformer implements TransformerInterface
{
    /**
     * Transforms a ScenarioId to a CollectionId
     * @param ScenarioId $id 
     * @return string 
     */
    public function transform($scenarioId) :CollectionId
    {
        if (!$scenarioId instanceof ScenarioId) {
            throw new InvalidArgumentException(
                sprintf('Can only transform "%s", "%s" received.', Id::class, gettype($scenarioId))
            );
        }
        $pieces = explode(ScenarioId::ID_SEPARATOR, $scenarioId->toString());
        return CollectionId::fromString($pieces[0]);
    }
}

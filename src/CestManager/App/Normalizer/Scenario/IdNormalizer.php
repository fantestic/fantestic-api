<?php

declare(strict_types = 1);
namespace App\CestManager\App\Normalizer\Scenario;


use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdNormalizer implements NormalizerInterface
{

    public function normalize($object, ?string $format = null, array $context = [])
    {
        return $object->toString();
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return ($data instanceof ScenarioId);
        
    }
}

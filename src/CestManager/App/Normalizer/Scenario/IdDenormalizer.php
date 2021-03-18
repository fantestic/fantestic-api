<?php

declare(strict_types = 1);
namespace App\CestManager\App\Normalizer\Scenario;


use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;


/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdDenormalizer implements DenormalizerInterface
{

    public function denormalize($data, string $type, ?string $format = null, array $context = [])
    {
        return ScenarioId::fromString($data);
    }

    public function supportsDenormalization($data, string $type, ?string $format = null)
    {
        return is_a($type, ScenarioId::class, true);
    }

    /*
    public function normalize($object, ?string $format = null, array $context = [])
    {
        return $object->toString();
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return ($data instanceof Id);
        
    }
    */
}

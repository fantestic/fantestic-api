<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Normalizer;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\CestManager\Collection\ValueObject\Id;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use App\CestManager\Collection\Entity\Collection;

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
        return ($data instanceof Id);
        
    }

}
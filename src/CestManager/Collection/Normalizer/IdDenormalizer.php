<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Normalizer;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\CestManager\Collection\ValueObject\Id;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
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
        try {
            return Id::fromString($data);
        } catch (InvalidIdentifierStringException $e) {
            throw new InvalidIdentifierException($e->getMessage());
        }
    }

    public function supportsDenormalization($data, string $type, ?string $format = null)
    {
        return is_a($type, id::class, true);
     }
    
}
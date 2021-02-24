<?php

declare(strict_types = 1);
namespace App\CestManager\Normalizer\Collection;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use App\CestManager\ValueObject\Collection\Id;
use App\CestManager\ValueObject\Exception\InvalidIdentifierStringException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Exception;

/**
 * Normalizes Collection Identifier
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdNormalizer implements DenormalizerInterface
{
    /**
     * @inheritdoc
     */
    public function denormalize($data, string $type, ?string $format = null, array $context = []) :Id
    {
        try {
            return Id::fromString($data);
        } catch (InvalidIdentifierStringException $e) {
            throw new InvalidIdentifierException($e->getMessage(), $e->getCode(), $e);
        }
    }


    public function supportsDenormalization($data, string $type, ?string $format = null) :bool
    {
        return is_a($type, Id::class, true);
    }
}
<?php

declare(strict_types = 1);
namespace App\CestManager\App\Normalizer\Action;

use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use App\CestManager\Domain\ValueObject\Action\Id;
use ArrayObject;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class IdNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;


    public function supportsNormalization($data, ?string $format = null, array $context = [])
    {
        return $data instanceof Id;
    }


    /**
     * 
     * @param Id $object 
     * @param string|null $format 
     * @param array $context 
     * @return array|string|int|float|bool|ArrayObject|null 
     * @throws InvalidArgumentException 
     * @throws CircularReferenceException 
     * @throws LogicException 
     * @throws ExceptionInterface 
     */
    public function normalize($object, ?string $format = null, array $context = [])
    {
        return $this->normalizer->normalize($object->toString(), $format, $context);
    }
}

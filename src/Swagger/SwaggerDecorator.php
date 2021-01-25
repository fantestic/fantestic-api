<?php

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);
        unset($docs['paths']['/api/steps/{id}']);
        unset($docs['paths']['/api/scenarios']['get']);


        return $docs;
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}

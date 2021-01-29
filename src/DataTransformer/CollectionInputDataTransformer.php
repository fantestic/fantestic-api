<?php

declare(strict_types = 1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Collection;


/**
 * DataTransformer for Collection Entity.
 * Creates Collection instances from Collection Input Dto's.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 */
final class CollectionInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = []) :Collection
    {
        // @todo validate
        $collection = new Collection($data->id);
        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Collection) {
          return false;
        }

        return Collection::class === $to && null !== ($context['input']['class'] ?? null);
    }
}

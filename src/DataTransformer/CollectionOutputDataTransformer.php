<?php

declare(strict_types = 1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Collection;
use App\Dto\CollectionOutput;


/**
 * DataTransformer for Collection Entity.
 * Creates CollectionOutput Dto from Collection Entities.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 */
final class CollectionOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = []) :CollectionOutput
    {
        $collection = new CollectionOutput();
        $collection->id = $data->getId();
        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return CollectionOutput::class === $to && $data instanceof Collection;
    }
}

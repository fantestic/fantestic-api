<?php

declare(strict_types = 1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Scenario;


/**
 * DataTransformer for Scenario Entity.
 * Creates Collection instances from Collection Input Dto's.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * 
 */
final class ScenarioInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = []) :Scenario
    {
        // @todo validate
        $scenario = new Scenario($data->id);
        return $scenario;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Scenario) {
          return false;
        }

        return Scenario::class === $to && null !== ($context['input']['class'] ?? null);
    }
}

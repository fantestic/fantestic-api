<?php

declare(strict_types = 1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Scenario;
use App\Dto\ScenarioOutput;


/**
 * DataTransformer for Scenario Entity.
 * Creates ScenarioOutput Dto from Scenario Entities.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * 
 */
final class ScenarioOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = []) :ScenarioOutput
    {
        $scenarioOut = new ScenarioOutput();
        $scenarioOut->id = $data->getId();
        $i = 0;
        foreach ($data->getSteps() as $step) {
            $scenarioOut->steps[] = [
                'position'  => $i++,
                'action'    => $step->getAction(),
                'arguments' => $step->getArguments()
            ];
        }
        return $scenarioOut;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ScenarioOutput::class === $to && $data instanceof Scenario;
    }
}

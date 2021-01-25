<?php

declare(strict_types = 1);

namespace App\Dto;

/**
 * Scenario Input Dto. Consumed by api write operations.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * 
 */
final class ScenarioInput
{
    /**
     * @todo typehint
     */
    public array $steps = [];

    public CollectionInput $collection;
}

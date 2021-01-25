<?php

declare(strict_types = 1);


namespace App\Dto;

/**
 * Step Output Dto. Consumed by api write operations.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * 
 */
final class StepOutput
{
    public int $position;
    public ActionOutput $action;
    /**
     * @var string[]
     */
    public array $arguments = [];
}

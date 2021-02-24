<?php

declare(strict_types = 1);
namespace App\CestManager\Transformer;

/**
 * Transform between various representations of a value
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface TransformerInterface
{
    /**
     * Transforms between value types.
     * 
     * @param mixed $value 
     * @return mixed 
     */
    public function transform(mixed $value) :mixed;
}
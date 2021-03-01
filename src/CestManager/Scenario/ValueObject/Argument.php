<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\ValueObject;


/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Argument
{
    private int $position;

    private mixed $value;


    public function getPosition() :int
    {
        return $this->position;
    }


    public function getValue() :mixed
    {
        return $this->value;
    }
}
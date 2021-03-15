<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\ValueObject;

use Fantestic\CestManager\Dto\ArgumentOut as ArgumentOutDto;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Argument
{
    public function __construct(
        private int $position,
        private mixed $value,
    ) {}


    public static function fromDto(ArgumentOutDto $dto, int $position) :Argument
    {
        return new self($position, $dto->getValue());
    }


    public function getPosition() :int
    {
        return $this->position;
    }


    public function getValue() :mixed
    {
        return $this->value;
    }
}

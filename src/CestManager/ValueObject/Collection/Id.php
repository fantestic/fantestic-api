<?php

declare(strict_types = 1);
namespace App\CestManager\ValueObject\Collection;

/**
 * Identifier for a Collection
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    private string $id;


    private function __construct(string $id)
    {
        $this->id = $id;
    }


    public static function fromString(string $id) :self
    {
        // @TODO VALIDATE
        return new self($id);
    }


    public static function fromPath(string $path) :self
    {
        // @TODO VALIDATE
        $encoded = str_replace(['+','/','='], ['-','_',''], base64_encode($path));
        return new self($encoded);
    }


    public function toString() :string
    {
        return $this->id;
    }


    public function toPath() :string
    {
        return base64_decode(str_replace(['-','_'], ['+','/'], $this->id));
    }


    public function __toString() :string
    {
        return $this->toString();
    }
}

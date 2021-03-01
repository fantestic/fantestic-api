<?php

declare(strict_types = 1);
namespace App\CestManager\Action\Entity;

use App\CestManager\Action\ValueObject\Id;
use App\CestManager\Action\ValueObject\Parameter;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Action
{
    private Id $id;

    /**
     * @var Parameter[]
     */
    private array $parameters;

    private string $readable;


    public function __construct(Id $id, string $readable, array $parameters)
    {
        $this->id = $id;
        $this->readable = $readable;
        $this->parameters = $parameters;
    }


    public function getId() :Id
    {
        return $this->id;
    }


    /**
     * 
     * @return Parameter[] 
     */
    public function getParameters() :iterable
    {
        foreach ($this->parameters as $parameter) {
            yield $parameter;
        }
    }


    public function getReadable() :string
    {
        return $this->readable;
    }
}

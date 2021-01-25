<?php 

declare(strict_types = 1);

namespace App\CodeParser\Action;

/**
 * Parameter Bag to be consumed by Actions
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 * 
 */
class ParameterList
{
    /**
     * @var ParameterTypeInterface[]
     */
    private array $parameters = [];

    /**
     * @param ParameterTypeInterface[] $parameters
     */
    public function __construct(array $parameters = [])
    {
        foreach ($parameters as $name => $type) {
            $this->addParameter($name, $type);
        }
    }

    public function addParameter(string $parameterName, ParameterTypeInterface $parameterType)
    {
        $this->parameters[$parameterName] = $parameterType;
    }

    /**
     * @return ParameterTypeInterface[]
     */
    public function getParameters() :array
    {
        return $this->parameters;
    }
}

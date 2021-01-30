<?php

declare(strict_types = 1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * A Scenario is composed of multiple steps a test runs through. It's essentially
 * a method inside a Cest class.
 * 
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 */
class Scenario
{
    /**
     * @var string the identifier of the Scenario.
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/",
     *     match=true,
     *     message="The identifier must be a valid PHP function name."
     * )
     * @ApiProperty(identifier=true)
     */
    private string $id;

    /**
     * @var Step[]
     */
    private array $steps = [];

    private Collection $collection;

    public function __construct(string $id, Collection $collection)
    {
        $this->collection = $collection;
        $this->setId($id);
        $this->steps = [];
    }

    /**
     * @param string $id the identifier that represents the scenario
     * 
     * @return string
     * @throws \OutOfRangeException
     */
    public function setId(string $id) :self
    {
        if (!preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $id)) {
          throw new \OutOfRangeException("'{$id}' is not a valid function name.");
        }
        $this->id = $id;
        return $this;
    }

    public function getId() :string
    {
        return $this->id;
    }

    public function getMethodName() :string
    {
        return $this->id;
    }

    /**
     * @return Step[]
     */
    public function getSteps() :array
    {
        return $this->steps;
    }

    public function addStep(Step $step) :self
    {
        $this->steps[] = $step;
        return $this;
    }

    public function getCollection() :Collection
    {
        return $this->collection;
    }
}

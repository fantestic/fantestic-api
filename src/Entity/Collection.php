<?php

declare(strict_types = 1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * A Collection of Scenarios. Represents a Cest Class.
 * 
 */
class Collection
{
    /**
     * @var string the identifier of the Collection.
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\\\\]*[a-zA-Z0-9_\x7f-\xff]$/",
     *     match=true,
     *     message="The identifier must be a valid PHP classname."
     * )
     * @ApiProperty(identifier=true)
     */
    private string $id;

    /**
     * @var Scenario[]
     */
    private array $scenario;


    /**
     * @param string $id the identifier to identify the collection
     * 
     * @throws \OutOfRangeException
     */
    public function __construct(string $id)
    {
        $this->setId($id);
    }

    /**
     * @param string $id the identifier that represents the collection
     * 
     * @return string
     * @throws \OutOfRangeException
     */
    public function setId(string $id) :self
    {
        if (!preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\\\\]*[a-zA-Z0-9_\x7f-\xff]$/', $id)) {
          throw new \OutOfRangeException("'{$id}' is not a valid ClassName");
        }
        $this->id = $id;
        return $this;
    }

    public function getId() :string
    {
        return $this->id;
    }

    /**
     * @return Scenario[]
     */
    public function getScenario() :array
    {
        return $this->scenario;
    }
}

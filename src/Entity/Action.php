<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;


/**
 * Possible Actions a Scenario can be composed of.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @ApiResource
 */
class Action
{
    /**
     * @var string the identifier of the action.
     * @Assert\NotBlank
     * @ApiProperty(identifier=true)
     */
    private string $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMethodName()
    {
        return $this->getId();
    }
}

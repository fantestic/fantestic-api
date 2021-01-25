<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * A single step inside a scenario.
 * @ApiResource
 */
class Step
{
    
    /**
     * @var string the identifier of the step.
     * @Assert\NotBlank
     * @ApiProperty(identifier=true)
     */
    private string $id;

    private Scenario $scenario;

    private Action $action;

    /**
     * @var string[]
     */
    private array $arguments;

    public function __construct()
    {
        // @todo placeholder as demo
        $this->id = 'collection::scenario:'.mt_rand();
        $this->action = new Action('amOnPage');
        $this->arguments = [
            'address' => '/example',
        ];
    }

    public function getAction() :Action
    {
        return $this->action;
    }

    public function getArguments()
    {
        return $this->arguments;
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Action\ValueObject;


/**
 * Action Parameters
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Parameter
{
    private string $name;

    public function getName() :string
    {
        return $this->name;
    }
}

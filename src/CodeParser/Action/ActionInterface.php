<?php 

declare(strict_types = 1);

namespace App\CodeParser\Action;

/**
 * Interface for all actions that can be performed by a scenario (Cest-method)
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 */
interface ActionInterface
{
    public function getMethodName() :string;

    public function getParameters() :ParameterList;
}

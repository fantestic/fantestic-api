<?php

declare(strict_types = 1);

namespace App\Scenario\Action;

use App\CodeParser\Action\ActionInterface;
use App\CodeParser\Action\ParameterList;
use App\CodeParser\ParameterType\UrlPath;

/**
 * Action to move the user to a predefined page.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class AmOnPage implements ActionInterface
{
    public function getMethodName() :string
    {
        return 'amOnPage';
    }

    public function getParameters() :ParameterList
    {
        return new ParameterList([
            'page' => new UrlPath(),
        ]);
    }
}

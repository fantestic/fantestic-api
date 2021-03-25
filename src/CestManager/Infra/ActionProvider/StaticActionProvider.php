<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\ActionProvider;

use App\CestManager\Infra\Contract\ActionProviderInterface;
use App\CestManager\Domain\Entity\Action;
use App\CestManager\Domain\ValueObject\Action\Id;
use App\CestManager\Domain\ValueObject\Action\Parameter;

/**
 * Generates a list of all ActionProviders using the Symfony ContainerBuilder.
 * 
 * @see App\Kernel::build()
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class StaticActionProvider implements ActionProviderInterface
{

    public function getActions() :iterable {
        $actions = [
            [
                'see',
                'I expect to see $text',
                [['name' => '$text', 'providers' => []]]
            ],
            [
                'dontSee',
                'I expect to not see $text',
                [['name' => '$text', 'providers' => []]]
            ],
            [
                'wait',
                'I wait $seconds seconds',
                [['name' => '$seconds', 'providers' => []]]
            ],
            [
                'amOnPage',
                'I am on page $page',
                [['name' => '$page', 'providers' => []]]
            ],
            [
                'fillField',
                'I fill field $field with value $value',
                [
                    ['name' => '$field', 'providers' => []],
                    ['name' => '$value', 'providers' => []],
                ]
            ],
            [
                'selectOption',
                'I select option $option from dropdown $dropdown',
                [
                    ['name' => '$option', 'providers' => []],
                    ['name' => '$dropdown', 'providers' => []],
                ]
            ],
            [
                'amOnUrl',
                'I am on $url',
                [['name' => '$url', 'providers' => []]],
            ],
            [
                'fillField',
                'I fill field $field with value $value',
                [
                    ['name' => '$field', 'providers' => []],
                    ['name' => '$value', 'providers' => []],
                ]
            ],
            [
                'click',
                'I click on $selector',
                [
                    ['name' => '$selector', 'providers' => []]
                ]
            ],
        ];
        foreach ($actions as $action) {
            yield $this->createAction($action);
        }
    }


    private function createAction(array $conf) :Action
    {
        $parameters = [];
        foreach ($conf[2] as $pos => $parameter) {
            $parameters[] = new Parameter($parameter['name'], $pos);
        }
        return new Action(
            Id::fromString($conf[0]),
            $conf[1],
            $parameters
        );
    }
}

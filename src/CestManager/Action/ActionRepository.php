<?php

declare(strict_types = 1);
namespace App\CestManager\Action;

use App\CestManager\Action\Entity\Action;
use App\CestManager\Action\ValueObject\Id;
use App\CestManager\Action\ActionProvider\ActionProviderCollection;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ActionRepository
{
    public function __construct(
        private ActionProviderCollection $actionProviderCollection
    ) {}


    /**
     * Returns a list of all existing Actions
     * 
     * @return iterable|Action[] 
     */
    public function findAll() :iterable
    {
        $actions = [];
        foreach ($this->actionProviderCollection->getActionProviders() as $actionProvider) {
            foreach ($actionProvider->getActions() as $action) {
                $actions[$action->getId()->toString()] = $action;
            }
        }
        return $actions;
    }


    public function find(string $identifier) :?Action
    {
        $actions = iterator_to_array($this->findAll());
        return array_key_exists($identifier, $actions)?$actions[$identifier]:null;
    }
}

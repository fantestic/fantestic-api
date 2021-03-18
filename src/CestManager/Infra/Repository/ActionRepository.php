<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\Repository;

use App\CestManager\Domain\Repository\ActionRepositoryInterface;
use App\CestManager\Domain\Entity\Action;
use App\CestManager\Infra\ActionProvider\ActionProviderCollection;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ActionRepository implements ActionRepositoryInterface
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
        $actions = (array)($this->findAll());
        return array_key_exists($identifier, $actions)?$actions[$identifier]:null;
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Contract;

use App\CestManager\Domain\Entity\Action;

/**
 * ActionProviders give access to available Actions inside fantestic.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface ActionProviderInterface
{
    const SERVICE_TAG = 'fantestic.action_provider';

    /**
     * 
     * @return iterable|Action[]
     */
    public function getActions() :iterable;
}

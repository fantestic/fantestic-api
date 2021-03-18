<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Repository;

use App\CestManager\Domain\Entity\Action;

/**
 * Repository to locate Actions
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface ActionRepositoryInterface
{
    /**
     * @return iterable|Action[] 
     */
    public function findAll() :iterable;

    public function find(string $identifier) :?Action;
}

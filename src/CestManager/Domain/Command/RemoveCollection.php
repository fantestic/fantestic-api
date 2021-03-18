<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Command;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * Command to delete a Collection from the system.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class RemoveCollection
{
    public function __construct(
        private Collection $collection
    ) {}


    public function getCollectionId() :CollectionId
    {
        return $this->collection->getid();
    }
}

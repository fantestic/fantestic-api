<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Scenario\ValueObject\Id;
use App\CestManager\Collection\ValueObject\Id as CollectionId;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Scenario
{
    private Id $id;

    /**
     * @var Collection
     */
    private ?Collection $collection = null;


    public function __construct(Id $id)
    {
        $this->id = $id;
    }


    public function getId() :Id
    {
        return $this->id;
    }


    public function getCollection() :?Collection
    {
        return $this->collection;
    }
}

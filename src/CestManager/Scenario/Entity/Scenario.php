<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\Entity;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Scenario\ValueObject\Id;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Scenario
{
    const ID_SEPARATOR = '::';
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

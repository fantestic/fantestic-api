<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Adapter;


use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Collection\Transformer\IdToPathTransformer;

/**
 * Adapter for consumption for Fantestic Collection
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class FantesticCollectionFactory
{
    public function __construct(
        private IdToNamespaceTransformer $idToNamespaceTransformer,
        private IdToPathTransformer $idToPathTransformer
    ) {}


    public function make(Collection $collection): FantesticCollection
    {
        return new FantesticCollection(
            $collection,
            $this->idToNamespaceTransformer,
            $this->idToPathTransformer
        );
    }
}

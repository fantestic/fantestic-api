<?php

declare(strict_types = 1);
namespace App\CestManager\Collection;

use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\ValueObject\Id;
use App\CestManager\Collection\Transformer\IdToPathTransformer;
use App\CestManager\Collection\Transformer\PathToIdTransformer;
use Fantestic\CestManager\Finder;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CollectionRepository
{
    public function __construct(
        private Finder $finder,
        private IdToPathTransformer $idToPathTransformer,
        private PathToIdTransformer $pathToIdTransformer
    ) {}


    /**
     * Returns a list of all existing Collections
     * 
     * @return iterable|Collection[] 
     */
    public function findAll() :iterable
    {
        foreach ($this->finder->listFiles() as $path) {
            yield new Collection($this->pathToIdTransformer->transform($path));
        }
    }


    /**
     * Finds a collection or returns null if the collection cant be found.
     * 
     * @param Id $id 
     * @return null|Collection 
     */
    public function find(Id $id) :?Collection
    {
        if ($this->finder->hasFile($this->idToPathTransformer->transform($id))) {
            return new Collection($id);
        } else {
            return null;
        }
    }
}

<?php

declare(strict_types = 1);

namespace App\CestManager\Application\Collection;

use App\CestManager\Application\Collection\Id\IdToFilenameConverter;
use App\CestManager\Domain\Collection\Repository;
use App\CestManager\Domain\Collection\Collection;
use App\CestManager\Domain\Collection\Id;

/**
 * Repository which uses the filesystem to fetch Collections
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class FilesystemRepository
{
    private string $basedir;
    private Finder $finder;
    private IdToFilenameConverter $idToFilenameConverter;

    public function __construct(
        string $basedir,
        Finder $finder,
        IdToFilenameConverter $idToFilenameConverter
    ) {
        $this->basedir = $basedir;
        $this->finder = $finder;
        $this->idToFilenameConverter = $idToFilenameConverter;
    }


    /**
     * Find a Scenario by its id. Returns null if Scenario cannot be found.
     * 
     * @param Id $id 
     * @return Scenario 
     */
    public function findById(Id $id) :?Collection
    {
        $filename = $this->idToFilenameConverter->convert($id);
        if ($this->finder->hasFile($filename)) {
            return new Collection($id);
        }
        return null;
    }
}

<?php

declare(strict_types = 1);

namespace App\CodeParser\Filesystem;

use App\CodeParser\Filesystem\Exception\FileNotFoundException;
use App\CodeParser\CestRep;
use Symfony\Component\Finder\Finder;
use App\ValueObject\Collection\Id as CollectionId;
use SplFileInfo;
use App\CodeParser\Factory\CestRepFactory;

/**
 * The CestFinder is responsible for searching for Cests in the filesystem. It can search
 * using different search patterns.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CestFinder
{
    private Finder $finder;
    private string $basedir;
    private CestRepFactory $cestRepFactory;

    /**
     * @param Finder $finder 
     * @param string $basedir 
     * @return void 
     * @throws FileNotFoundException 
     */
    public function __construct(
        Finder $finder,
        string $basedir,
        CestRepFactory $cestRepFactory
    ) {
        $this->finder = $finder;
        $this->setBasedir($basedir);
        $this->cestRepFactory = $cestRepFactory;
    }

    /**
     * Finds a Cest by a CollectionId
     * 
     * @param CollectionId $id 
     * @return CestRep 
     */
    public function findCollectionById(CollectionId $id) :CestRep
    {
        $fullyQualifiedPath = $this->basedir . DIRECTORY_SEPARATOR . $this->getClassSubpath($id);
        return $this->cestRepFactory->makeFromPath($fullyQualifiedPath);
    }


    private function getClassSubpath(CollectionId $id) :string
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $id->toString()) . 'Cest.php';
    }


    /**
     * 
     * @param string $basedir 
     * @return void 
     * @throws FileNotFoundException 
     */
    private function setBasedir(string $basedir) :void
    {
        $realpath = realpath($basedir);
        if ($realpath === false) {
            throw new FileNotFoundException("'{$basedir}' is not a valid directory.");
        }
        $this->basedir = $realpath;
    }
}

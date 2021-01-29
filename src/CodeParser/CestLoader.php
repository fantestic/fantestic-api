<?php

declare(strict_types = 1);

namespace App\CodeParser;

use Symfony\Component\Finder\Finder;
use App\Entity\Collection;
use SplFileInfo;
use OutOfBoundsException;

/**
 * Manages Reading of CestFiles 
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @package Fantestic
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CestLoader
{
    private Finder $finder;
    private string $basedir;

    public function __construct(Finder $finder, string $cestsDir)
    {
        $this->finder = $finder;
        $this->basedir = $cestsDir;
        $this->finder;
    }


    /**
     * @return Collection[]
     */
    public function findCests() :iterable
    {
        if ($this->finder->files()->in($this->basedir)->name('*Cest.php')->hasResults()) {
            foreach ($this->finder as $file) {
                yield $this->makeCollectionFromSplFileInfo($file);
            }
        }
    }


    /**
     * @throws OutOfBoundsException
     */
    public function findCestById(string $id) :Collection
    {
        $this->finder->files()->in($this->basedir)->name($this->getFilenameFromId($id));
        if ($this->finder->hasResults()) {
            return new Collection($id);
        } else {
            throw new OutOfBoundsException("Unknown Cest for id '{$id}'!");
        }
    }


    public function createCest($id) :void
    {
        //$path = $this->basedir . PATH_SEPARATOR . $this->getFilenameFromId($id);
        
    }


    private function makeCollectionFromSplFileInfo(SplFileInfo $splFileInfo) :Collection
    {
        return new Collection($splFileInfo->getBasename('Cest.php'));
    }


    private function getFilenameFromId(string $id) :string
    {
        return $id.'Cest.php';
    }
}

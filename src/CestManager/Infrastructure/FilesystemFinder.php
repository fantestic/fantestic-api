<?php

declare(strict_types = 1);

namespace App\CestManager\Infrastructure;

use App\CestManager\Application\Collection\Finder;
use App\Tests\Unit\CestManager\Collection\Exception\NotFoundException;

/**
 * Filsystem Finder.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class FilesystemFinder implements Finder
{
    private string $basepath;

    public function __construct(string $basepath)
    {
        $this->basepath = $basepath;
    }

    /**
     * @inheritdoc 
     */
    public function hasFile(string $subpath): bool
    {
        return file_exists($this->buildFullpath($subpath));
    }


    /**
     * @inheritdoc
     */
    public function getFileContent(string $subpath) :string
    {
        if (!$this->hasFile($subpath)) {
            throw new NotFoundException(
                "File '{$subpath}' could not be found."
            );
        }
        return file_get_contents($this->buildFullpath($subpath));
    }


    /**
     * @inheritdoc
     */
    public function listFiles() :array
    {
        return $this->walkRecursively();
    }


    /**
     * 
     * @param string $subpath 
     * @return array 
     */
    private function walkRecursively(string $subpath = '') :array
    {
        $files = [];
        foreach ($this->list($this->buildFullpath($subpath)) as $fileToCheck) {
            if (is_dir($this->buildFullpath($this->mergePath($subpath, $fileToCheck)))) {
                $files = array_merge($files, $this->walkRecursively($this->mergePath($subpath, $fileToCheck)));
            } else {
                $files[] = $this->mergePath($subpath, $fileToCheck);
            }
        }
        return $files;
    }


    private function list(string $fullpath) :array
    {
        return array_diff(scandir($fullpath), ['.', '..']);
    }


    private function convertToSubpath(string $fullpath) :string
    {
        return substr($fullpath, strlen($this->basepath));
    }


    /**
     * Builds a full directory path
     * 
     * @param string $subpath 
     * @return string 
     */
    private function buildFullpath(string $subpath) :string
    {
        return $this->mergePath($this->basepath, $subpath);
    }


    /**
     * Merges 2 paths
     * 
     * @param string $basepath 
     * @param string $subpath 
     * @return string 
     */
    private function mergePath(string $basepath, string $subpath) :string
    {
        if ($basepath === '' || $subpath === '') {
            return $basepath . $subpath;
        }
        return $basepath . DIRECTORY_SEPARATOR . $subpath;
    }
}

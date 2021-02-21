<?php

declare(strict_types = 1);

namespace App\CestManager\Application\Collection;

use App\CestManager\Application\Collection\Exception\NotFoundException;

/**
 * Interface used by the Repository to access the Filesystem.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface Finder
{
    /**
     * @throws NotFoundException
     * @return string 
     */
    public function getFileContent(string $subpath) :string;

    /**
     * Checks for the existence of a file
     * @param string $subpath 
     * @return bool 
     */
    public function hasFile(string $subpath) :bool;

    /**
     * Walks all directories recursively and returns a list with all files.
     * 
     * @return array 
     */
    public function listFiles() :array;
}

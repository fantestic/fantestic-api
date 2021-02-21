<?php

declare(strict_types = 1);

namespace App\CestManager\Application\Collection\Id;

use App\CestManager\Domain\Collection\Id;

/**
 *
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class IdToFilenameConverter
{
    public function convert(Id $id) :string
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $id->toString());
        return "{$path}Cest.php";
    }
}

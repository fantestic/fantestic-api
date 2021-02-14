<?php

declare(strict_types = 1);

namespace App\CodeParser\Factory;

use App\CodeParser\CestRep;
use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use PhpParser\ParserFactory;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CestRepFactory
{
    private ParserFactory $parserFactory;

    public function __construct(ParserFactory $parserFactory)
    {
        $this->parserFactory = $parserFactory;
    }

    /**
     * @throws CestNotFoundException
     * @param string $fullyQualifiedPath 
     * @return CestRep 
     */
    public function makeFromPath(string $fullyQualifiedPath) :CestRep
    {
        return new CestRep($fullyQualifiedPath, $this->parserFactory);
    }
}

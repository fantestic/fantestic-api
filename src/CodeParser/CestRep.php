<?php

declare(strict_types = 1);
namespace App\CodeParser;

use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use PhpParser\ParserFactory;
use PhpParser\Error;

/**
 * CestRep is responsible for manipulating the AST of a Cest Object. It retrieves
 * information and manipulates the AST of a Cest.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CestRep
{
    private string $fullyQualifiedPath;
    private ParserFactory $parserFactory;
    private $ast;

    /**
     * @throws CestNotFoundException
     * @throws Error
     * @param string $fullyQualifiedPath 
     * @return void 
     */
    public function __construct(
        string $fullyQualifiedPath,
        ParserFactory $parserFactory
    ) {
        if (!file_exists($fullyQualifiedPath)) {
            throw new CestNotFoundException(
                "Cest in file '{$fullyQualifiedPath}' not found!"
            );
        }
        $this->fullyQualifiedPath = $fullyQualifiedPath;
        $this->parserFactory = $parserFactory;
        $this->setupAst();
    }

    /**
     * @throws Error
     * @return void 
     */
    private function setupAst() 
    {
        $parser = $this->parserFactory->create(ParserFactory::PREFER_PHP7);
        $this->ast = $parser->parse(file_get_contents($this->fullyQualifiedPath));
        var_dump($this->ast);
        exit();
    }
}

<?php

declare(strict_types = 1);
namespace App\CodeParser;

use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use PhpParser\ParserFactory;
use PhpParser\Error;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;

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
    private array $ast;
    private Class_ $classNode;

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


    public function getAst()
    {
        return $this->ast;
    }

    /**
     * @throws Error
     * @return void 
     */
    private function setupAst() 
    {
        $parser = $this->parserFactory->create(ParserFactory::PREFER_PHP7);
        $this->ast = $parser->parse(file_get_contents($this->fullyQualifiedPath));
    }

    private function traverseAst(NodeVisitor $visitor) :void
    {
        $traverser = new NodeTraverser();
        $traverser->addVisitor($visitor);
        $traverser->traverse($this->ast);
    }
}

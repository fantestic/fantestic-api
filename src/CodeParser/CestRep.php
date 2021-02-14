<?php

declare(strict_types = 1);
namespace App\CodeParser;

use App\CodeParser\Filesystem\Exception\CestNotFoundException;
use App\CodeParser\NodeVisitor\FindMethodNodeVisitor;
use App\CodeParser\Factory\ScenarioRepFactory;
use LogicException;
use PhpParser\ParserFactory;
use PhpParser\Error;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use phpDocumentor\Reflection\DocBlockFactory;

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
    private ScenarioRepFactory $scenarioRepFactory;
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
        ParserFactory $parserFactory,
        ScenarioRepFactory $scenarioRepFactory
    ) {
        if (!file_exists($fullyQualifiedPath)) {
            throw new CestNotFoundException(
                "Cest in file '{$fullyQualifiedPath}' not found!"
            );
        }
        $this->fullyQualifiedPath = $fullyQualifiedPath;
        $this->parserFactory = $parserFactory;
        $this->scenarioRepFactory = $scenarioRepFactory;
        $this->setupAst();
    }


    /**
     * 
     * @return Node[] 
     */
    public function getAst() :array
    {
        return $this->ast;
    }


    /**
     * Searches for a scenario and returns it as a ScenarioRep
     * 
     * @param string $methodName 
     * @return null|ScenarioRep 
     * @throws LogicException 
     */
    public function findScenario(string $methodName) :?ScenarioRep
    {
        $visitor = new FindMethodNodeVisitor($methodName);
        $this->traverseAst($visitor);
        // -----------------------------------
        // I need to extract the comment (see ScenarioRep and CUT/paste code over)
        // Then create 2 types of ScenarioRep. Readonly and Writeable
        // And return Writeable only if @fantestic is given
        // -----------------------------------
        return $this->scenarioRepFactory->makeFromClassMethod($visitor->getMethodNode());
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


    private function commentHasFantesticTag(string $comment)
    {
        $factory  = DocBlockFactory::createInstance();
        $docblock = $factory->create($comment);
        return $docblock->hasTag('fantestic');
    }
}

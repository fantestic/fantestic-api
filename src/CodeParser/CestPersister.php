<?php

declare(strict_types = 1);

namespace App\CodeParser;

use PhpParser\PrettyPrinter\Standard as PrettyPrinter;
use RuntimeException;

/**
 * Persists Cests/Collections to the filesystem. 
 * 
 * @author Gerald Baumeister <gerald.b@fantestic.io>
 * @package Fantestic
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CestPersister
{
    private string $basedir;
    private bool $lockFileOnWrite;


    /**
     * @param string $cestsDir 
     * @param bool $lockFileOnWrite sets LOCK_EX when writing Cests
     */
    public function __construct(string $cestsDir, bool $lockFileOnWrite = true)
    {
        $this->basedir = $cestsDir;
        $this->lockFileOnWrite = $lockFileOnWrite;
    }


    /**
     * @throws RuntimeException 
     */
    public function persistCest(CestWrapper $cestWrapper) :self
    {
        $path = $this->getFullCestPath($cestWrapper->getClassname());
        $content = $this->prettyPrintFile($cestWrapper);
        $flags = $this->lockFileOnWrite?LOCK_EX:0;
        $response = file_put_contents($path, $content, $flags);
        if (false === $response) {
            throw new \RuntimeException("Failed to persist Cest '{$cestWrapper->getClassname()}'.");
        }
        return $this;
    }


    /**
     * @throws RuntimeException 
     */
    private function getFullCestPath(string $classname) :string
    {
        return ($this->basedir . DIRECTORY_SEPARATOR . $this->getFilenameFromClassname($classname));
    }


    private function prettyPrintFile(CestWrapper $cestWrapper) :string
    {
        $prettyPrinter = new PrettyPrinter();
        return $prettyPrinter->prettyPrintFile([$cestWrapper->getStmts()]);
    }


    private function getFilenameFromClassname(string $classname) :string
    {
        return $classname.'.php';
    }
}

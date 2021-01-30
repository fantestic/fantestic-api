<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

use App\CodeParser\CestBuilder;
use \org\bovigo\vfs\vfsStream;
use \org\bovigo\vfs\vfsStreamDirectory;
use App\Entity\Collection;

class CestBuilderTest extends \Codeception\Test\Unit
{
    private vfsStreamDirectory $root;
    private CestBuilder $cestBuilder;

    protected function _before() :void
    {
        $this->root = vfsStream::setup('root', null, []);
        //$this->cestBuilder = new CestBuilder($this->root->url(), 'TestNs\\CestNs');
    }

/*
    public function testCreateClassFromCollectionGeneratesClass() :void
    {
        $collection = new Collection('Abc');
        $wrapper = $this->cestBuilder->createClassFromCollection($collection);
        //$content = ($this->root->url() . DIRECTORY_SEPARATOR . 'AbcCest.php');
        
    }
    */
}

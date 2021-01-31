<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

// Trait only seem to be autoloaded once
// @TODO investigate details and report bug
require_once(__DIR__.'/TestTraits/CestTemplateTrait.php');

use App\Tests\UnitTester;
use App\CodeParser\CestPersister;
use App\CodeParser\CestWrapper;
use \org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStream;

use App\Tests\CodeParser\TestTraits\CestTemplateTrait;

class CestPersisterTest extends \Codeception\Test\Unit
{
    use CestTemplateTrait;

    protected UnitTester $tester;
    private vfsStreamDirectory $root;

    protected function _before() :void
    {
        $this->root = vfsStream::setup('root', null, $this->getFilesystemStructure());
    }


    public function testPersistCestsCreatesNewCest() :void
    {
        $cestPersister = $this->getPersister();
        $cestWrapper = new CestWrapper($this->getClass_('Empty'));
        $cestPersister->persistCest($cestWrapper);
        $this->assertFileExists($this->root->url().'/EmptyCest.php');
    }


    public function testPersistCestsOverwritesExisting() :void
    {
        $cestPersister = $this->getPersister('/dir1');
        $cestWrapper = new CestWrapper($this->getClass_('List'));
        $cestPersister->persistCest($cestWrapper);
        $this->assertFileExists($this->root->url().'/dir1/ListCest.php');
    }


    private function getPersister(string $subdir = '') :CestPersister
    {
        // vfsStreams do not support LOCK_EX
        // see https://github.com/bovigo/vfsStream/issues/44
        return new CestPersister($this->root->url().$subdir, false);
    }


    private function getFilesystemStructure() :array
    {
        return  [
            'dir1' => [
                'ListCest.php' => '',
                'Test2Cest.php' => '',
                'Test3Cest.php' => ''
            ],
        ];
    }
}

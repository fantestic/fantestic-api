<?php

declare(strict_types = 1);

namespace App\Tests\DataProvider;

use App\Tests\UnitTester;
use App\CodeParser\CestLoader;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Finder\Finder;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DataProvider\CollectionDataProvider;
use App\Entity\Collection;
use \org\bovigo\vfs\vfsStreamDirectory;

class CollectionDataProviderTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    private vfsStreamDirectory $root;
    private array $filesystem;
    private CestLoader $cestLoader;

    protected function _before() :void
    {
        $this->filesystem = [
            'Test1Cest.php' => '',
        ];
        $this->root = vfsStream::setup('root', null, $this->filesystem);
        $this->cestLoader = new CestLoader(Finder::create(), $this->root->url());
    }

    
    protected function _after()
    {
    }


    public function testReturnsCollection() :void
    {
        $result = $this->makeCollectionDataProvider()->getCollection(Collection::class);
        $this->assertEquals($this->allExistingCollections(), iterator_to_array($result));
    }


    public function throwsExceptionIfGetCollectionHasDifferentResourceClasses() :void
    {
        $this->expectException(ResourceClassNotSupportedException::class);
        $this->makeCollectionDataProvider()->getCollection(self::class);
    }


    public function testGetItemReturnsCollection() :void
    {
        $id = $this->anExistingId();
        $collection = $this->makeCollectionDataProvider()->getItem(Collection::class, $id);
        $this->assertEquals(new Collection($id), $collection);
    }


    public function testGetItemsReturnsNullIfCestIsNotFound() :void
    {
        $result = $this->makeCollectionDataProvider()->getItem(Collection::class, 'NoneExistingCest');
        $this->assertNull($result);
    }

    
    private function makeCollectionDataProvider(CestLoader $cestLoader = null) :CollectionDataProvider
    {
        if (is_null($cestLoader)) {
            $cestLoader = $this->cestLoader;
        }
        return new CollectionDataProvider($cestLoader);
    }


    private function anExistingId() :string
    {
        $existingCollections = $this->allExistingCollectionIds();
        return $existingCollections[array_rand($existingCollections)];
    }

    /**
     * @return Collection[]
     */
    private function allExistingCollections() :array
    {
        $collections = [];
        foreach ($this->allExistingCollectionIds() as $id) {
            $collections[] = new Collection($id);
        }
        return $collections;
    }

    /**
     * @return string[]
     */
    private function allExistingCollectionIds() :array
    {
        return [
            'Test1'
        ];
    }
}
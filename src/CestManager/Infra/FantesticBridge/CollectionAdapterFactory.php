<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\FantesticBridge;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionAdapterFactory
{
    public function __construct(
        private string $prefix,
        private string $suffix
    ) { }

    public function makeFromCollection(Collection $collection)
    {
        return new CollectionAdapter($collection->getId(), $this->prefix, $this->suffix);
    }

    public function makeFromCollectionId(CollectionId $collectionId)
    {
        return new CollectionAdapter($collectionId, $this->prefix, $this->suffix);
    }

    public function makeFromSubpath(string $subpath) :CollectionAdapter
    {
        $nsNormalized = str_replace('/', CollectionId::NS_SEPARATOR, $subpath);
        $collectionId = CollectionId::fromStringRepr(
            substr($nsNormalized, 0, -1*strlen($this->suffix.'.php'))
        );
        return $this->makeFromCollectionId($collectionId);
    }
}

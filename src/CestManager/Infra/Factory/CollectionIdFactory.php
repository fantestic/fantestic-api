<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\Factory;

use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use App\CestManager\Domain\ValueObject\Scenario\Id as ScenarioId;
use App\CestManager\Domain\ValueObject\Collection\Prefix;
use App\CestManager\Domain\ValueObject\Collection\Suffix;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionIdFactory
{
    public function __construct(
        private string $prefix,
        private string $suffix
    ) {}


    public function fromStringRepr(string $stringRepr) :CollectionId
    {
        return new CollectionId(
            $stringRepr,
            new Prefix($this->prefix),
            new Suffix($this->suffix)
        );
    }


    public function fromSubpath(string $subpath) :CollectionId
    {
        $nsNormalized = str_replace('/', Collectionid::NS_SEPARATOR, $subpath);
        return $this->fromStringRepr(
            substr($nsNormalized, 0, -1*strlen($this->suffix.'.php'))
        );
    }


    public function fromScenarioId(ScenarioId $id) :CollectionId
    {
        return $this->fromStringRepr(
            $id->getCollectionIdRepr()
        );
    }
}

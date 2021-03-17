<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Adapter;


use Fantestic\CestManager\Contract\CollectionInterface;
use App\CestManager\Collection\Entity\Collection;
use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Collection\Transformer\IdToPathTransformer;

/**
 * Adapter for consumption for Fantestic Collection
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class FantesticCollection implements CollectionInterface
{
    public function __construct(
        private Collection $collection,
        private IdToNamespaceTransformer $idToNamespaceTransformer,
        private IdToPathTransformer $idToPathTransformer
    ) {}

    public function getScenarios(): iterable
    {
        return $this->collection->getScenarios();
    }


    public function getClassname(): string
    {
        $fullyQualifiedName = $this->idToNamespaceTransformer->transform(
            $this->collection->getId()
        );
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, $classnameSeparatorPos +1);
        }
    }


    public function getNamespace(): string
    {
        $fullyQualifiedName = $this->idToNamespaceTransformer->transform(
            $this->collection->getId()
        );
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, 0, $classnameSeparatorPos);
        }
    }


    public function getSubpath() :string
    {
        return $this->idToPathTransformer->transform($this->collection->getId());
    }


    public function getFullyQualifiedClassname() :string
    {
        return $this->getNamespace() . '\\' . $this->getClassname();
    }
}

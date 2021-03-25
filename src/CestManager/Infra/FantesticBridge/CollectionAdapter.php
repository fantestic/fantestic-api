<?php

declare(strict_types = 1);
namespace App\CestManager\Infra\FantesticBridge;

use App\CestManager\Domain\Entity\Collection;
use App\CestManager\Domain\Entity\Scenario;
use App\CestManager\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManager\Contract\CollectionInterface;

/**
 * An adapter to make internal Collections compatible to Fantestics CestManager.
 * It adds a configured prefix/suffix to the fully Qualified Classname of the Cests.
 * The prefix/suffix can be injected from the service-container via config.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionAdapter implements CollectionInterface
{
    private iterable $scenarios = [];

    public function __construct(
        private CollectionId $collectionId,
        private string $prefix,
        private string $suffix
    ) { }

    public function setScenarios(iterable $scenarios) :void
    {
        $this->scenarios = $scenarios;
    }

    /**
     * 
     * @return iterable|Scenario[]
     */
    public function getScenarios(): iterable
    {
        // @TODO to be removed
        return $this->scenarios;
    }

    public function getClassname(): string
    {
        $fullyQualifiedName = $this->getFullyQualifiedClassname();
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, $classnameSeparatorPos +1);
        }
    }

    public function getNamespace(): string
    {
        $fullyQualifiedName = $this->getFullyQualifiedClassname();
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, 0, $classnameSeparatorPos);
        }
    }

    public function getSubpath(): string
    {
        return 
            str_replace(
                CollectionId::NS_SEPARATOR,
                DIRECTORY_SEPARATOR,
                $this->collectionId->toString()
            ) .
            $this->suffix
            . '.php';
    }

    public function getFullyQualifiedClassname(): string
    {
        return 
            $this->prefix . 
            str_replace(CollectionId::NS_SEPARATOR, '\\', $this->collectionId->toString()) .
            $this->suffix;
    }
  
}

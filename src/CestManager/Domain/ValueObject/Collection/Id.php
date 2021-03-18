<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\ValueObject\Collection;

use App\CestManager\Domain\Exception\ValueObject\InvalidIdentifierStringException;

/**
 * Identifier for a Collection
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Id
{
    const NS_SEPARATOR = '-';

    public function __construct(
        private string $id,
        private Prefix $prefix,
        private Suffix $suffix
    ) {
        if (1 !== preg_match('/^[a-z0-9_-]+$/i', $id)) {
            throw new InvalidIdentifierStringException(
                sprintf('"%s" is not considered a valid Collection Id!', $id)
            );
        }
    }


    public function toString() :string
    {
        return $this->id;
    }


    public function __toString() :string
    {
        return $this->toString();
    }


    public function getClassname() :string
    {
        $fullyQualifiedName = $this->getFullyQualifiedClassname();
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, $classnameSeparatorPos +1);
        }
    }


    public function getNamespace() :string
    {
        $fullyQualifiedName = $this->getFullyQualifiedClassname();
        $classnameSeparatorPos = strrpos($fullyQualifiedName, '\\');
        if (false === $classnameSeparatorPos) {
            return $fullyQualifiedName;
        } else {
            return substr($fullyQualifiedName, 0, $classnameSeparatorPos);
        }
    }


    public function getFullyQualifiedClassname() :string
    {
        return 
            $this->prefix . 
            str_replace(self::NS_SEPARATOR, '\\', $this->id) .
            $this->suffix;
    }


    public function getSubpath() :string
    {
        return 
            str_replace(
                self::NS_SEPARATOR,
                DIRECTORY_SEPARATOR,
                $this->toString()
            ) .
            $this->suffix
            . '.php';
    }
}

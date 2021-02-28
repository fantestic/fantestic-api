<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Transformer;

use App\CestManager\Contract\TransformerInterface;
use App\CestManager\Collection\ValueObject\Id;
use InvalidArgumentException;

/**
 * Transforms a CollectionId to a PHP-Namespace
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class NamespaceToIdTransformer implements TransformerInterface
{
    public function __construct(
        private string $prefix
    ) { }


    /**
     * Transforms a PHP-Namespace to a CollectionId
     * @param Id $id 
     * @return string 
     */
    public function transform($namespace) :Id
    {
        if (!is_string($namespace)) {
            throw new InvalidArgumentException(
                sprintf('Can only transform strings, "%s" received.', gettype($namespace))
            );
        }
        $namespaced = str_replace('\\', '-', $namespace);
        return Id::fromString(substr($namespaced, -1 * strlen($this->prefix) + 1));
    }
}

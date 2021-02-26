<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Transformer;

use App\CestManager\Contract\TransformerInterface;
use App\CestManager\Collection\ValueObject\Id;
use InvalidArgumentException;

/**
 * Transforms a CestPath to a CollectionId
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class PathToIdTransformer implements TransformerInterface
{
    public function __construct(
        private string $suffix
    ) { }


    /**
     * Transform a CestPath to a CollectionId
     * @param string $path 
     * @return Id 
     */
    public function transform($path) :Id
    {
        if (!is_string($path)) {
            throw new InvalidArgumentException(
                sprintf('Can only transform strings, %s received.', gettype($path))
            );
        }
        $pathWithoutSuffix = substr($path, 0, -1 * strlen($this->suffix));
        return Id::fromReadable($pathWithoutSuffix);
    }
}

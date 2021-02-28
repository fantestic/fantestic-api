<?php

declare(strict_types = 1);
namespace App\CestManager\Collection\Transformer;

use App\CestManager\Contract\TransformerInterface;
use App\CestManager\Collection\ValueObject\Id;
use InvalidArgumentException;

/**
 * Transforms CollectionIds to paths
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToPathTransformer implements TransformerInterface
{
    public function __construct(
        private string $suffix
    ) { }


    /**
     * Transform a CollectionId to a CestPath
     * @param Id $id 
     * @return string 
     */
    public function transform($id) :string
    {
        if (!$id instanceof Id) {
            throw new InvalidArgumentException(
                sprintf('Can only transform "%s", "%s" received.', Id::class, gettype($id))
            );
        }
        $path = str_replace('-', DIRECTORY_SEPARATOR, $id->toString());
        return $path . $this->suffix;
    }
}

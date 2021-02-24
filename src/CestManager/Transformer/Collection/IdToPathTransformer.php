<?php

declare(strict_types = 1);
namespace App\CestManager\Transformer\Collection;

use App\CestManager\Transformer\TransformerInterface;
use App\CestManager\ValueObject\Collection\Id;
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
        return $id->toReadable() . $this->suffix;
    }
}

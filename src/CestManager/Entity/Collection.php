<?php

declare(strict_types = 1);
namespace App\CestManager\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\CestManager\ValueObject\Collection\Id;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get']
)]
final class Collection
{
    #[ApiProperty(identifier:true)]
    protected Id $id;


    public function __construct(Id $id)
    {
        $this->id = $id;
    }


    public function getId() :Id
    {
        return $this->id;
    }
}

<?php

declare(strict_types = 1);
namespace App\CestManager\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
#[ApiResource]
class Collection
{
    #[ApiProperty(identifier:true)]
    private int $id;

    /**
     * 
     * @var iterable
     */
    public iterable $scenarios;
}

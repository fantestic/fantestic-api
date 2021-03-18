<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Exception\ValueObject;

use DomainException;

/**
 * Exception if an identifier cannot be created due to the string having an
 * invalid format!
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class InvalidIdentifierStringException extends DomainException
{
    // intentionally left blank
}

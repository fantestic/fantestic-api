<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Scenario\Transformer;

use App\CestManager\Scenario\Transformer\IdToCollectionIdTransformer;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToCollectionIdTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $filename = 'Dir/File';
        $collectionId = CollectionId::fromReadable($filename);
        $scenarioId = ScenarioId::fromReadable($filename.'::'.'methodname');
        $t = new IdToCollectionIdTransformer();
        $this->assertEquals($collectionId, $t->transform($scenarioId));
    }
}

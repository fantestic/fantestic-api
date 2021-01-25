<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

use App\CodeParser\Action\ParameterList;
use App\CodeParser\Action\ParameterInterface;

class ParameterListTest extends \Codeception\Test\Unit
{
    public function testSavesAndReturnsCollections() :void
    {
        /**
         * @var ParameterInterface
         */
        $parameter = $this->makeEmpty(ParameterInterface::class);
        $parameterList = new ParameterList();
        $parameterList->addParameter($parameter);
        $result = $parameterList->getParameters();
        $this->assertCount(1, $result);
        $this->assertSame($parameter, current($result));
    }
}

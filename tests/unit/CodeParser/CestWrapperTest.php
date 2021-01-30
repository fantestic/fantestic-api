<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

use App\CodeParser\CestWrapper;
use App\Entity\Scenario;
use App\Entity\Collection;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Class_;


class CestWrapperTest extends \Codeception\Test\Unit
{

    protected function _before() :void
    {
    }

    public function testFindsAlreadyExistingScenarios() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = new Scenario($class->stmts[0]->name->toString(), $this->createCollectionMock());
        $methodNode = $wrapper->findScenario($scenario);
        $this->assertEquals($class->stmts[0], $methodNode);
    }

    public function testWritesScenario() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = $this->createScenarioMock();
        $wrapper->writeScenario($scenario);
        $method = $wrapper->findScenario($scenario);
        $this->assertNotNull($method);
    }

    private function getClass_(string $template) :Class_
    {
        $stmts = $this->parseTemplate($template);
        return $stmts[1]->stmts[0];
    }

    private function parseTemplate(string $template) :array
    {
        $code = $this->getTemplate($template);
        $factory = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        return $factory->parse($code);
    }

    private function getTemplate($name) :string
    {
        return file_get_contents(__DIR__ . "/Templates/{$name}.php.tpl");
    }

    private function createScenarioMock() :Scenario
    {
        /**
         * @var Scenario
         */
        $s = $this->createMock(Scenario::class);
        return $s;
    }

    private function createCollectionMock() :Collection
    {
        /**
         * @var Collection
         */
        $s = $this->createMock(Collection::class);
        return $s;
    }
}

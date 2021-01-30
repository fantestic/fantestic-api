<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser;

use App\CodeParser\CestWrapper;
use App\Entity\Scenario;
use App\Entity\Step;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Class_;


class CestWrapperTest extends \Codeception\Test\Unit
{

    protected function _before() :void
    {
    }

    public function testFindsScenario() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = new Scenario('firstTest');
        $methodNode = $wrapper->findScenario($scenario);
        $this->assertEquals($class->stmts[0], $methodNode);
    }

    public function testWritesScenario() :void
    {
        $class = $this->getClass_('Empty');
        $wrapper = new CestWrapper($class);
        $scenario = new Scenario('addedTest');
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
}

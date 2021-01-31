<?php

declare(strict_types = 1);

namespace App\Tests\CodeParser\TestTraits;

use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Class_;

trait CestTemplateTrait
{
    protected function getClass_(string $template) :Class_
    {
        $stmts = $this->parseTemplate($template);
        return $stmts[1]->stmts[0];
    }


    protected function parseTemplate(string $template) :array
    {
        $code = $this->getTemplate($template);
        $factory = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        return $factory->parse($code);
    }


    protected function getTemplate($name) :string
    {
        return file_get_contents(__DIR__ . "/../../../Fixtures/Cest/{$name}Cest.php");
    }

}
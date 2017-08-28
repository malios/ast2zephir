<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\ParseStatements;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Else_ extends Generator
{
    use ParseStatements;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::ELSE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Else_ $node
     */
    protected function doGenerateCode($node): string
    {
        $code = 'else {';
        if (!empty($node->stmts)) {
            $statementsCode = $this->parseStatements($this->finder, ...$node->stmts);
            $code .= PHP_EOL . $this->indent($statementsCode) . PHP_EOL;
        }
        $code .= '}';
        return $code;
    }
}

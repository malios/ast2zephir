<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class ElseIf_ extends Generator
{
    use ParseStatements;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::ELSEIF;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\ElseIf_ $node
     */
    protected function doGenerateCode($node): string
    {
        $conditionGenerator = $this->finder->find($node->cond->getType());
        $code = 'elseif ' . $conditionGenerator->generateCode($node->cond) . ' {';
        if (!empty($node->stmts)) {
            $statementsCode = $this->parseStatements($this->finder, ...$node->stmts);
            $code .= PHP_EOL . $this->indent($statementsCode) . PHP_EOL;
        }
        $code .= '}';
        return $code;
    }
}

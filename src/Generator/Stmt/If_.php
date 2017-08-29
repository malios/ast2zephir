<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class If_ extends Generator
{
    use ParseStatements;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::IF;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\If_ $node
     */
    protected function doGenerateCode($node): string
    {
        $conditionGenerator = $this->finder->find($node->cond->getType());
        $code = 'if ';
        $code .= $conditionGenerator->generateCode($node->cond) . ' {';
        if (!empty($node->stmts)) {
            $statementsCode = $this->parseStatements($this->finder, ...$node->stmts);
            $code .= PHP_EOL . $this->indent($statementsCode) . PHP_EOL;
        }
        $code .= '}';

        if (!empty($node->elseifs)) {
            $code .= $this->parseElseIfs(...$node->elseifs);
        }

        if ($node->else) {
            $elseGenerator = $this->finder->find($node->else->getType());
            $code .= ' ' . $elseGenerator->generateCode($node->else);
        }

        return $code;
    }

    private function parseElseIfs(Node\Stmt\ElseIf_ ...$elseifs)
    {
        $code = '';
        foreach ($elseifs as $elif) {
            $generator = $this->finder->find($elif->getType());
            $code .= ' ' .  $generator->generateCode($elif);
        }

        return $code;
    }
}

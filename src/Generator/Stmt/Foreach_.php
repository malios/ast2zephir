<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;
use PhpParser\Node\Expr\Variable;

final class Foreach_ extends Generator
{
    use NodeToCode;
    use ParseStatements;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::FOREACH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Foreach_ $node
     */
    protected function doGenerateCode($node): string
    {
        if ($node->byRef) {
            $this->logger->notice('Iterating by reference is not supported in Zephir', ['node' => $node]);
        }

        $code = '';
        $variables = $this->getVariablesToDeclare($node);
        if (!empty($variables)) {
            $code .= 'var ' . join(', ', $variables) . ';' . PHP_EOL;
        }

        $code .= 'for ';
        $value = $this->nodeToCode($node->valueVar, $this->finder);
        if ($node->keyVar !== null) {
            $key = $this->nodeToCode($node->keyVar, $this->finder);
            $code .= $key . ', ';
        }

        $code .= $value;

        $expr = $this->nodeToCode($node->expr, $this->finder);
        $code .= ' in ' . $expr . ' {' . PHP_EOL;

        $statements = $this->parseStatements($this->finder, ...$node->stmts);
        $code .= $this->indent($statements) . PHP_EOL . '}';

        return $code;
    }

    private function getVariablesToDeclare(Node\Stmt\Foreach_ $node)
    {
        $variables = [];

        /** @var null|Variable $key */
        $key = $node->keyVar;
        if ($key !== null && $key->getType() === Expr::VARIABLE) {
            $variables[] = $key->name;
        }

        /** @var null|Variable $val */
        $val = $node->valueVar;
        if ($val !== null && $val->getType() === Expr::VARIABLE) {
            $variables[] = $val->name;
        }

        return $variables;
    }
}

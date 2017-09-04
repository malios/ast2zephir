<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;
use PhpParser\Node\Expr\Assign;

final class For_ extends Generator
{
    use NodeToCode;
    use ParseStatements;

    private $template = <<<'EOT'
%s
while(%s) {
%s
%s
}
EOT;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::FOR;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\For_ $node
     */
    protected function doGenerateCode($node): string
    {
        $initCode = $this->getInitCode($node);
        $conditionCode = $this->getConditionCode($node);
        $stmtsCode = $this->parseStatements($this->finder, ...$node->stmts);
        $pcCode = $this->getPostConditionCode($node);

        $code = sprintf($this->template, $initCode, $conditionCode, $this->indent($stmtsCode), $this->indent($pcCode));
        return $code;
    }

    private function getVariablesToDeclare(Node\Stmt\For_ $node)
    {
        $variables = [];

        /** @var Assign|Node $init */
        foreach ($node->init as $init) {
            if ($init->getType() === Expr::ASSIGN) {
                $variables[] = $init->var->name;
            }
        }

        return $variables;
    }

    private function getInitCode(Node\Stmt\For_ $node): string
    {
        $code = '';
        $variables = $this->getVariablesToDeclare($node);
        if (!empty($variables)) {
            $code .= 'var ' . join(', ', $variables) . ';' . PHP_EOL;
        }

        $init = array_map(function (Node $n) {
            return $this->nodeToCode($n, $this->finder);
        }, $node->init);

        $code .= join(';' . PHP_EOL, $init) . ';';
        return $code;
    }

    private function getConditionCode(Node\Stmt\For_ $node): string
    {
        $conditions = array_map(function (Node $n) {
            return $this->nodeToCode($n, $this->finder);
        }, $node->cond);

        $code = join(' && ', $conditions);
        return $code;
    }

    private function getPostConditionCode(Node\Stmt\For_ $node): string
    {
        $conditions = array_map(function (Node $n) {
            return $this->nodeToCode($n, $this->finder);
        }, $node->loop);

        $code = join(';' . PHP_EOL, $conditions) . (count($conditions) > 0 ? ';' : '');
        return $code;
    }
}

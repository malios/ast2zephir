<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Modifiers;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;
use PhpParser\Node\Param;

final class ClassMethod extends Generator
{
    use Modifiers;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::CLASS_METHOD;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\ClassMethod $node
     */
    protected function doGenerateCode($node): string
    {
        if ($node->returnsByRef()) {
            $this->logger->notice('Returning by reference is not supported in Zephir', ['node' => $node]);
        }

        $code = $this->getModifiers($node) . ' function ' . $node->name . '(';
        if (!empty($node->params)) {
            $code .= $this->parseParams(...$node->params);
        }

        $code .= ')' . PHP_EOL . '{';
        if (!empty($node->stmts)) {
            $parsedStatements = $this->parseStatements(...$node->stmts);
            $code .= PHP_EOL . $this->indent($parsedStatements) . PHP_EOL;
        }

        $code .= '}';
        return $code;
    }

    private function parseParams(Param ...$params): string
    {
        $paramsArray = array_map(function (Param $param) {
            $generator = $this->finder->find($param->getType());
            return $generator->generateCode($param);
        }, $params);

        return join(', ', $paramsArray);
    }

    private function parseStatements(Node ...$stmts)
    {
        $code = '';
        $variables = $this->getVariablesToAssign(...$stmts);
        if (!empty($variables)) {
            $code = 'var ' . join(', ', $variables) . ';' . PHP_EOL;
        }

        $last = count($stmts) - 1;
        foreach ($stmts as $index => $stmt) {
            $generator = $this->finder->find($stmt->getType());
            $code .= $generator->generateCode($stmt) . ';';
            if ($index !== $last) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }

    private function getVariablesToAssign(Node ...$stmts) : array
    {
        $variables = [];
        foreach ($stmts as $stmt) {
            if ($stmt->getType() === Expr::ASSIGN && $stmt->var->getType() === Expr::VARIABLE) {
                $variables[] = $stmt->var->name;
            }
        }

        return array_unique($variables);
    }
}

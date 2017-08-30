<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\Modifiers;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Generator\Common\ReturnType;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Param;

final class ClassMethod extends Generator
{
    use Modifiers;
    use ReturnType;
    use ParseStatements;

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

        $code .= ')';
        $returnType = $this->getReturnTypeDeclaration($node);
        if (!empty($returnType)) {
            $code .= ' ' . $returnType;
        }

        $code .= PHP_EOL . '{' . PHP_EOL;
        if (!empty($node->stmts)) {
            $parsedStatements = $this->parseMethodStatements(...$node->stmts);
            $code .= $this->indent($parsedStatements) . PHP_EOL;
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

    private function parseMethodStatements(Node ...$stmts)
    {
        $code = '';

        $variables = [];
        foreach ($stmts as $stmt) {
            $variables = array_merge($variables, $this->getVariablesToAssign($stmt));
        }

        $variables = array_unique($variables);
        if (!empty($variables)) {
            $code = 'var ' . join(', ', $variables) . ';' . PHP_EOL;
        }

        $code .= $this->parseStatements($this->finder, ...$stmts);
        return $code;
    }

    private function getVariablesToAssign($node) : array
    {
        $variables = [];

        // todo: use is_iterable with php 7.1
        if (is_array($node)) {
            foreach ($node as $elem) {
                $variables = array_merge($variables, $this->getVariablesToAssign($elem));
            }

            return $variables;
        } elseif ($this->isVariableToAssign($node)) {
            $variables[] = $node->var->name;
        } elseif (!is_object($node)) {
            return $variables;
        }

        foreach (get_object_vars($node) as $prop) {
            if ($prop instanceof Node || is_array($prop)) {
                $variables = array_merge($variables, $this->getVariablesToAssign($prop));
            }
        }

        return $variables;
    }

    /**
     * @param Node|Assign|mixed $node
     * @return bool
     */
    private function isVariableToAssign($node)
    {
        return $node instanceof Node
            && $node->getType() === Expr::ASSIGN
            && $node->var->getType() === Expr::VARIABLE;
    }
}

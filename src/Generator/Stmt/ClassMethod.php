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
use PhpParser\Node\Stmt\Switch_;

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
        $variables = $this->getVariablesToAssign(...$stmts);
        if (!empty($variables)) {
            $code = 'var ' . join(', ', $variables) . ';' . PHP_EOL;
        }

        $code .= $this->parseStatements($this->finder, ...$stmts);
        return $code;
    }

    private function getVariablesToAssign(Node ...$stmts) : array
    {
        $variables = [];
        /** @var Node|Assign|Switch_ $stmt */
        foreach ($stmts as $stmt) {
            if ($stmt->getType() === Expr::ASSIGN && $stmt->var->getType() === Expr::VARIABLE) {
                $variables[] = $stmt->var->name;
            }

            if ($innerStatements = $stmt->stmts ?? $stmt->cases ?? false) {
                $variables = $variables + $this->getVariablesToAssign(...$innerStatements);
            }
        }

        return array_unique($variables);
    }
}

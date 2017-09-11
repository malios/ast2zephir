<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Common\Parameters;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\Modifiers;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Generator\Common\ReturnType;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;
use PhpParser\Node\Expr\Assign;

final class ClassMethod extends Generator
{
    use Modifiers;
    use ReturnType;
    use ParseStatements;
    use Parameters;
    use NodeToCode {
        NodeToCode::nodeToCode insteadof Parameters;
    }

    private $template = <<<'EOT'
%sfunction %s(%s)%s%s
EOT;


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

        $modifiers = $this->getModifiers($node);
        if (!empty($modifiers)) {
            $modifiers .= ' ';
        }

        $params = $this->getParameters($this->finder, ...$node->params);
        $paramsCode = join(', ', $params);
        $returnType = $this->getReturnTypeDeclaration($node);
        if (!empty($returnType)) {
            $returnType = ' ' . $returnType;
        }

        $body = '';
        if ($node->stmts !== null) {
            $parsedStatements = $this->parseMethodStatements(...$node->stmts);
            if (!empty($parsedStatements)) {
                $parsedStatements = $this->indent($parsedStatements) . PHP_EOL;
            }

            $body = PHP_EOL . '{' . PHP_EOL . $parsedStatements . '}';
        }

        $code = sprintf($this->template, $modifiers, $node->name, $paramsCode, $returnType, $body);
        return $code;
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

        if ($node instanceof Node && $this->isLoop($node)) {
            return [];
        }

        // todo: use is_iterable with php 7.1
        if (is_array($node)) {
            foreach ($node as $elem) {
                $variables = array_merge($variables, $this->getVariablesToAssign($elem));
            }

            return $variables;
        } elseif ($this->isVariableToAssign($node)) {
            $variables[] = $node->var->name;
        } elseif ($node instanceof Node && $node->getType() === Expr::LIST) {
            $variables = array_merge($variables, $this->getListVariables($node));
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
    private function isVariableToAssign($node): bool
    {
        return $node instanceof Node
            && $node->getType() === Expr::ASSIGN
            && $node->var->getType() === Expr::VARIABLE;
    }

    private function isLoop(Node $node): bool
    {
        return $node->getType() === Stmt::FOR || $node->getType() === Stmt::FOREACH;
    }

    private function getListVariables(Node\Expr\List_ $node): array
    {
        $variables = [];
        foreach ($node->items as $item) {
            if ($item->value->getType() === Expr::VARIABLE) {
                $variables[] = $this->nodeToCode($item, $this->finder);
            }
        }

        return $variables;
    }
}

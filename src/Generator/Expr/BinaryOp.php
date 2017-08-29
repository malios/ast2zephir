<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Exception\GeneratorException;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class BinaryOp extends Generator
{
    const NOT_AVAILABLE = 'NA';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $this->isBinary($node);
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\BinaryOp $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        // add parentheses for nested binary operations
        if ($this->getConfig('parentheses')) {
            $code .= '(';
        }

        $left = $this->generateNext($node->left);
        $right = $this->generateNext($node->right);

        $op = $this->getOperator($node);
        if ($op === self::NOT_AVAILABLE) {
            $code .= $this->parseAlternative($node, $left, $right);
        } else {
            $code .= $left . ' ' . $op . ' ' . $right;
        }

        if ($this->getConfig('parentheses')) {
            $code .= ')';
        }
        return $code;
    }

    private function isBinary(Node $node): bool
    {
        return strpos($node->getType(), Expr::BINARY_OP) > -1;
    }

    private function getOperator(Node\Expr\BinaryOp $node): string
    {
        $operators = [
            Expr::BINARY_OP_PLUS => '+',
            Expr::BINARY_OP_MINUS => '-',
            Expr::BINARY_OP_MULTIPLY => '*',
            Expr::BINARY_OP_DIVIDE => '/',
            Expr::BINARY_OP_EQUAL => '==',
            Expr::BINARY_OP_NOT_EQUAL => '!=',
            Expr::BINARY_OP_IDENTICAL => '===',
            Expr::BINARY_OP_NOT_IDENTICAL => '!==',
            Expr::BINARY_OP_CONCAT => '.',
            Expr::BINARY_OP_GREATER => '>',
            Expr::BINARY_OP_GREATER_OR_EQUAL => '>=',
            Expr::BINARY_OP_SMALLER => '<',
            Expr::BINARY_OP_SMALLER_OR_EQUAL => '<=',
            Expr::BINARY_OP_MODULUS => '%',
            Expr::BINARY_OP_BITWISE_AND => '&',
            Expr::BINARY_OP_BITWISE_OR => '|',
            Expr::BINARY_OP_BITWISE_XOR => '^',
            Expr::BINARY_OP_BOOLEAN_AND => '&&',
            Expr::BINARY_OP_BOOLEAN_OR => '||',
            Expr::BINARY_OP_LOGICAL_AND => '&&', // todo: add notice for usage of logical and, or, xor
            Expr::BINARY_OP_LOGICAL_OR => '||',
            Expr::BINARY_OP_LOGICAL_XOR => '^',
            Expr::BINARY_OP_SHIFT_LEFT => '<<',
            Expr::BINARY_OP_SHIFT_RIGHT => '>>',
        ];

        $notAvailableOperators = [
            Expr::BINARY_OP_POW => self::NOT_AVAILABLE
        ];

        $operator = $operators[$node->getType()] ?? $notAvailableOperators[$node->getType()] ?? '';
        if (empty($operator)) {
            throw new GeneratorException(sprintf(
                'Operator not found for expression %s',
                $node->getType()
            ));
        }

        return $operator;
    }

    private function parseAlternative(Node\Expr\BinaryOp $node, string $left, string $right): string
    {
        switch ($node->getType()) {
            case Expr::BINARY_OP_POW:
                $code = sprintf('pow(%s, %s)', $left, $right);
                break;
            default:
                throw new GeneratorException(sprintf("Alternative for %s not found", $node->getType()));
        }

        return $code;
    }

    /**
     * Generate code for the right or left of the binary expression
     *
     * @param Node $node
     * @return string
     */
    private function generateNext(Node $node): string
    {
        $generator = $this->finder->find($node->getType());
        if ($this->isBinary($node) && $node->getType() !== Expr::BINARY_OP_CONCAT) {
            $generator->addConfig('parentheses', true);
        }
        $next = $generator->generateCode($node);
        return $next;
    }
}

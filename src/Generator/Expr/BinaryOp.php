<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
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
        return strpos($node->getType(), Expr\BinaryOp::BINARY_OP) > -1;
    }

    private function getOperator(Node\Expr\BinaryOp $node): string
    {
        $operators = [
            Expr\BinaryOp::PLUS => '+',
            Expr\BinaryOp::MINUS => '-',
            Expr\BinaryOp::MULTIPLY => '*',
            Expr\BinaryOp::DIVIDE => '/',
            Expr\BinaryOp::EQUAL => '==',
            Expr\BinaryOp::NOT_EQUAL => '!=',
            Expr\BinaryOp::IDENTICAL => '===',
            Expr\BinaryOp::NOT_IDENTICAL => '!==',
            Expr\BinaryOp::CONCAT => '.',
            Expr\BinaryOp::GREATER => '>',
            Expr\BinaryOp::GREATER_OR_EQUAL => '>=',
            Expr\BinaryOp::SMALLER => '<',
            Expr\BinaryOp::SMALLER_OR_EQUAL => '<=',
            Expr\BinaryOp::MODULUS => '%',
            Expr\BinaryOp::BITWISE_AND => '&',
            Expr\BinaryOp::BITWISE_OR => '|',
            Expr\BinaryOp::BITWISE_XOR => '^',
            Expr\BinaryOp::BOOLEAN_AND => '&&',
            Expr\BinaryOp::BOOLEAN_OR => '||',
            Expr\BinaryOp::LOGICAL_AND => '&&', // todo: add notice for usage of logical and, or, xor
            Expr\BinaryOp::LOGICAL_OR => '||',
            Expr\BinaryOp::LOGICAL_XOR => '^',
            Expr\BinaryOp::SHIFT_LEFT => '<<',
            Expr\BinaryOp::SHIFT_RIGHT => '>>',
        ];

        $notAvailableOperators = [
            Expr\BinaryOp::POW => self::NOT_AVAILABLE
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
            case Expr\BinaryOp::POW:
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
        if ($this->isBinary($node) && $node->getType() !== Expr\BinaryOp::CONCAT) {
            $generator->addConfig('parentheses', true);
        }
        $next = $generator->generateCode($node);
        return $next;
    }
}

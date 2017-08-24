<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Exception\GeneratorException;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class BinaryOp extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return strpos($node->getType(), Expr::BINARY_OP) > -1;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\BinaryOp $node
     */
    protected function doGenerateCode($node): string
    {
        $leftGen = $this->finder->find($node->left->getType());
        $rightGen = $this->finder->find($node->right->getType());
        $op = $this->getOperator($node);
        $code = $leftGen->generateCode($node->left) . ' ' . $op . ' ' . $rightGen->generateCode($node->right);
        return $code;
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
        ];

        $operator = $operators[$node->getType()] ?? '';
        if (empty($operator)) {
            throw new GeneratorException(sprintf(
                'Operator not found for expression %s',
                $node->getType()
            ));
        }

        return $operator;
    }
}

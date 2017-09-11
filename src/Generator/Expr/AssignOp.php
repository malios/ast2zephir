<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Exception\GeneratorException;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class AssignOp extends Generator
{
    use NodeToCode;

    /**
     * E.g: let str = str . "tail"
     * Operations assign-*** are very unreliable in zephir so we'll use assign + binary op.
     *
     * @see https://github.com/phalcon/zephir/issues/1573
     * @var string
     */
    private $template = 'let %s = %s %s %s';

    private $operators = [
        Expr::ASSIGN_OP_CONCAT => '.',
        Expr::ASSIGN_OP_PLUS => '+',
        Expr::ASSIGN_OP_MINUS => '-',
        Expr::ASSIGN_OP_DIV => '/',
        Expr::ASSIGN_OP_MUL => '*',
        Expr::ASSIGN_OP_BITWISE_AND => '&',
        Expr::ASSIGN_OP_BITWISE_OR => '|',
        Expr::ASSIGN_OP_BITWISE_XOR => '^',
        Expr::ASSIGN_OP_BITWISE_MOD => '%',
        Expr::ASSIGN_OP_SHIFT_LEFT => '<<',
        Expr::ASSIGN_OP_SHIFT_RIGHT => '>>',
    ];

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $this->isAssignOp($node);
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\AssignOp $node
     */
    protected function doGenerateCode($node): string
    {
        $type = $node->getType();
        $operator = $this->operators[$type] ?? null;
        if ($operator === null) {
            throw new GeneratorException(sprintf('Cannot find operator for node of type %s', $type));
        }

        $var = $this->nodeToCode($node->var, $this->finder);
        $expr = $this->nodeToCode($node->expr, $this->finder);
        $code = sprintf($this->template, $var, $var, $operator, $expr);
        return $code;
    }

    private function isAssignOp(Node $node): bool
    {
        return strpos($node->getType(), Expr::ASSIGN_OP) > -1;
    }
}

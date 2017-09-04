<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\Assign as ExprAssign;

final class Assign extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::ASSIGN;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprAssign $node
     */
    protected function doGenerateCode($node): string
    {
        $type = $node->expr->getType();
        $next = $this->finder->find($type);
        $value = $next->generateCode($node->expr, false);
        $left = 'let ' . $node->var->name . ' = ';

        if ($node->expr->getType() === Expr::FUNC_CALL) {
            // kind of a hack to insert the assigning operation in the correct place
            // @see FuncCall::doGenerateCode() for more info
            return sprintf($value, $left);
        }

        return $left . $value;
    }
}

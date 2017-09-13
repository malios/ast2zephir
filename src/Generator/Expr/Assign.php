<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\Assign as ExprAssign;

final class Assign extends Generator
{
    use NodeToCode;

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
        if ($node->var->getType() === Expr::LIST) {
            /** @var List_ $listGen */
            $listGen = $this->finder->find(Expr::LIST);
            $listGen->setListArrayExpression($node->expr);

            // in zephir list language construct is not supported
            return $listGen->generateCode($node->var);
        }

        $value = $this->nodeToCode($node->expr, $this->finder,false);
        $left = 'let ' . $this->nodeToCode($node->var, $this->finder) . ' = ';
        if ($this->isCallable($node->expr)) {
            // kind of a hack to insert the assigning operation in the correct place
            // @see FuncCall::doGenerateCode() for more info
            return sprintf($value, $left);
        }

        return $left . $value;
    }

    private function isCallable(Node $node): bool
    {
        $callables = [
            Expr::FUNC_CALL,
            Expr::STATIC_CALL,
            Expr::METHOD_CALL,
            Expr::NEW,
        ];

        return in_array($node->getType(), $callables);
    }
}

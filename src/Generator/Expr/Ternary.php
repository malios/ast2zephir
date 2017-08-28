<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Ternary extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::TERNARY;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Ternary $node
     */
    protected function doGenerateCode($node): string
    {
        $conditionGenerator = $this->finder->find($node->cond->getType());
        $caseTrueGenerator = $this->finder->find($node->if->getType());
        $caseFalseGenerator = $this->finder->find($node->else->getType());

        $code = '(' . $conditionGenerator->generateCode($node->cond) . ')'
            . ' ? '
            . $caseTrueGenerator->generateCode($node->if)
            . ' : '
            . $caseFalseGenerator->generateCode($node->else);

        return $code;
    }
}

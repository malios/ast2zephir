<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class UnaryPlus extends Generator
{
    use NodeToCode;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::UNARY_PLUS;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\UnaryPlus $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '+' . $this->nodeToCode($node->expr, $this->finder);
        return $code;
    }
}

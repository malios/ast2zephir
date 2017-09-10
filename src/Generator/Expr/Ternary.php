<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Ternary extends Generator
{
    use NodeToCode;

    private $longSyntaxTemplate = "%s ? %s : %s";
    private $shortSyntaxTemplate = "%s ?: %s";

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
        $cond = $this->nodeToCode($node->cond, $this->finder);
        $else = $this->nodeToCode($node->else, $this->finder);

        if ($node->if === null) {
            $code = sprintf($this->shortSyntaxTemplate, $cond, $else);
        } else {
            $if = $this->nodeToCode($node->if, $this->finder);
            $code = sprintf($this->longSyntaxTemplate, $cond, $if, $else);
        }

        return $code;
    }
}

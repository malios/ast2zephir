<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Empty_ extends Generator
{
    use NodeToCode;

    private $template = 'empty(%s)';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::EMPTY;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Empty_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expr = $this->nodeToCode($node->expr, $this->finder);
        $code = sprintf($this->template, $expr);
        return $code;
    }
}

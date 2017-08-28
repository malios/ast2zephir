<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Print_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::PRINT;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Print_ $node
     */
    protected function doGenerateCode($node): string
    {
        $generator = $this->finder->find($node->expr->getType());
        $code = 'echo ' . $generator->generateCode($node->expr);
        return $code;
    }
}

<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Exit_ extends Generator
{
    private $template = 'exit%s';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::EXIT;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Exit_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expr = '';
        if ($node->expr !== null) {
            $next = $this->finder->find($node->expr->getType());
            $expr = sprintf('(%s)', $next->generateCode($node->expr));
        }

        $code = sprintf($this->template, $expr);
        return $code;
    }
}

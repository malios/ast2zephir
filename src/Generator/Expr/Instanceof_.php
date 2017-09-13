<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Instanceof_ extends Generator
{
    use NodeToCode;

    private $template = '%s instanceof %s';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::INSTANCEOF;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Instanceof_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expr = $this->nodeToCode($node->expr, $this->finder);
        $class = $this->nodeToCode($node->class, $this->finder);

        $code = sprintf($this->template, $expr, $class);
        return $code;
    }
}

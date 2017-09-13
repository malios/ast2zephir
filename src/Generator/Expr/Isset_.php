<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class Isset_ extends Generator
{
    use NodeToCode;

    private $template = 'isset(%s)';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::ISSET;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\Isset_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expressions = array_map(function (Node $n) {
            $var = $this->nodeToCode($n, $this->finder);
            $isset = sprintf($this->template, $var);
            return $isset;
        }, $node->vars);

        $code = join(' && ', $expressions);
        return $code;
    }
}

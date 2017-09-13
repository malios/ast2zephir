<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class ArrayDimFetch extends Generator
{
    use NodeToCode;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::ARRAY_DIM_FETCH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\ArrayDimFetch $node
     */
    protected function doGenerateCode($node): string
    {
        $var = $this->nodeToCode($node->var, $this->finder);
        if ($node->dim === null) {
            $dim = '';
        } else {
            $dim = $this->nodeToCode($node->dim, $this->finder);
        }
        $code = $var . '[' . $dim . ']';
        return $code;
    }
}

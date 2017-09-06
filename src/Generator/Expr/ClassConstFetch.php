<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch as ExprClassConstFetch;

final class ClassConstFetch extends Generator
{
    use NodeToCode;

    private $template = '%s::%s';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::CLASS_CONST_FETCH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprClassConstFetch $node
     */
    protected function doGenerateCode($node): string
    {
        $accessor = $this->nodeToCode($node->class, $this->finder);
        $code = sprintf($this->template, $accessor, $node->name);

        return $code;
    }
}

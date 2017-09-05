<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticPropertyFetch as ExprStaticPropertyFetch;

final class StaticPropertyFetch extends Generator
{
    private $template = '%s::%s';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::STATIC_PROPERTY_FETCH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprStaticPropertyFetch $node
     */
    protected function doGenerateCode($node): string
    {
        $accessor = join('\\', $node->class->parts);
        $code = sprintf($this->template, $accessor, $node->name);
        return $code;
    }
}

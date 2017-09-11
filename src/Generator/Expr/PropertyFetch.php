<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\PropertyFetch as ExprPropertyFetch;

final class PropertyFetch extends Generator
{
    use NodeToCode;

    private $template = '%s->%s';
    private $fetchByVariableTemplate = '%s->{%s}';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::PROPERTY_FETCH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprPropertyFetch $expr
     */
    protected function doGenerateCode($expr): string
    {
        $left = $expr->var->name;
        if ($expr->name instanceof Node) {
            $right = $this->nodeToCode($expr->name, $this->finder);
            $template = $this->fetchByVariableTemplate;
        } else {
            $right = $expr->name;
            $template = $this->template;
        }

        $code = sprintf($template, $left, $right);
        return $code;
    }
}

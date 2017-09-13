<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\Arguments;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class FuncCall extends Generator
{
    use Arguments;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::FUNC_CALL;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\FuncCall $node
     */
    protected function doGenerateCode($node): string
    {
        // variable assign withing function call if such exists
        $code = $this->getAssignCode($node, $this->finder);

        $arguments = $this->getArguments($node, $this->finder);

        /**
         * Since zephir does not support variable assign in function call we have to work around it
         * we use %s to let the caller to inject it's own code in specific place.
         * E.g the following php code:
         * <code>
         *     $lower = strtolower($upper = strtoupper($original = join($glue, $arr)));
         * </code>
         *
         * Will be converted to:
         *
         * <code>
         *     let original = join(glue, arr);
         *     let upper = strtoupper(original);
         *     let lower = strtolower(upper);
         * </code>
         */
        $code .= '%s' . join('\\', $node->name->parts) . '(' . join(', ', $arguments) . ')';
        return $code;
    }
}

<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class FuncCall extends Generator
{
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
        $code = '';
        $arguments = [];
        foreach ($node->args as $arg) {
            if ($arg->value->getType() === Expr::ASSIGN) {
                $arguments[] = $arg->value->var->name;
                $gen = $this->finder->find($arg->value->getType());
                $code = $gen->generateCode($arg->value) . ';' . PHP_EOL . $code;
            } else {
                $gen = $this->finder->find($arg->value->getType());
                $arguments[] = $gen->generateCode($arg->value);
            }
        }

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

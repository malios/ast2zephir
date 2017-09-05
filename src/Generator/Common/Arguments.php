<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Common;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Expr\New_;
use Malios\Ast2Zephir\Generator\Expr\StaticCall;
use Malios\Ast2Zephir\Generator\Finder;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\MethodCall;

trait Arguments
{
    /**
     * Arguments to pass into function or method call
     *
     * @param Node|FuncCall|MethodCall|StaticCall|New_ $node
     * @param Finder $finder
     * @return string[]
     */
    public function getArguments(Node $node, Finder $finder): array
    {
        $arguments = [];
        foreach ($node->args as $arg) {
            if ($arg->value->getType() === Expr::ASSIGN) {
                $arguments[] = $arg->value->var->name;
            } else {
                $gen = $finder->find($arg->value->getType());
                $arguments[] = $gen->generateCode($arg->value);
            }
        }

        return $arguments;
    }

    /**
     * Zephir alternative of variable assign within function or method call
     *
     * e.g:
     * <code>
     *     $upper = strtoupper($original = 'test');
     * </code>
     *
     * @param Node|FuncCall|MethodCall $node
     * @param Finder $finder
     * @return string
     */
    public function getAssignCode(Node $node, Finder $finder): string
    {
        $code = '';
        foreach ($node->args as $arg) {
            if ($arg->value->getType() === Expr::ASSIGN) {
                $gen = $finder->find($arg->value->getType());
                $code = $gen->generateCode($arg->value) . ';' . PHP_EOL . $code;
            }
        }

        return $code;
    }
}

<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class Unset_ extends Generator
{
    use NodeToCode;

    private $template = 'unset(%s)';

    // In Zephir if you call unset on variable it will produce compiler error. So we have to work around that.
    private $workaroundTemplate = 'let %s = null';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::UNSET;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Unset_ $node
     */
    protected function doGenerateCode($node): string
    {
        $stmts = array_map(function (Node $var) {
            $template = ($var->getType() === Expr::VARIABLE) ? $this->workaroundTemplate : $this->template;
            $expr = $this->nodeToCode($var, $this->finder);
            $code = sprintf($template, $expr);
            return $code;
        }, $node->vars);

        $code = join( ';' . PHP_EOL, $stmts);
        return $code;
    }
}

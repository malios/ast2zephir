<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class Catch_ extends Generator
{
    use NodeToCode;
    use ParseStatements;

    private $template = <<<'EOT'
catch %s, %s{
%s
}
EOT;


    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::CATCH;
    }

    /**
     * {@inheritdoc}private
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Catch_ $node
     */
    protected function doGenerateCode($node): string
    {
        $stmts = $this->parseStatements($this->finder, ...$node->stmts);

        $exceptions = array_map(function (Node $ex) {
            return $this->nodeToCode($ex, $this->finder);
        }, $node->types);
        $exceptionsCode = join('|', $exceptions);

        $code = sprintf($this->template, $exceptionsCode, $node->var, $this->indent($stmts));
        return $code;
    }
}

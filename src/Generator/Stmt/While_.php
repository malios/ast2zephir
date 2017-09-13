<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class While_ extends Generator
{
    use NodeToCode;
    use ParseStatements;

    private $template = <<<'EOT'
while(%s) {
%s
}
EOT;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::WHILE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\While_ $node
     */
    protected function doGenerateCode($node): string
    {
        $conditionsCode = $this->nodeToCode($node->cond, $this->finder);
        $stmtsCode = $this->parseStatements($this->finder, ...$node->stmts);
        $code = sprintf($this->template, $conditionsCode, $this->indent($stmtsCode));
        return $code;
    }
}

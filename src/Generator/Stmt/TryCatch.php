<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;
use PhpParser\Node\Stmt\Catch_;

final class TryCatch extends Generator
{
    use NodeToCode;
    use ParseStatements;

    private $template = <<<'EOT'
%s
try {
%s
} %s
EOT;


    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::TRY_CATCH;
    }

    /**
     * {@inheritdoc}private
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\TryCatch $node
     */
    protected function doGenerateCode($node): string
    {
        $variables = $this->getVariablesToInit(...$node->catches);
        $variablesCode = 'var ' . join(', ', $variables) . ';';

        $stmts = $this->parseStatements($this->finder, ...$node->stmts);
        $catches = $this->parseCatches(...$node->catches);

        $code = sprintf($this->template, $variablesCode, $this->indent($stmts), $catches);
        return $code;
    }

    private function parseCatches(Catch_ ...$catches)
    {
        $catchesParsed = array_map(function (Catch_ $catch) {
            return $this->nodeToCode($catch, $this->finder);
        }, $catches);

        $code = join(' ', $catchesParsed);
        return $code;
    }

    /**
     * In Zephir first we need to init the exception variables before catching them.
     *
     * @param Catch_[] ...$catches
     * @return array
     */
    private function getVariablesToInit(Catch_ ...$catches): array
    {
        $variables = array_map(function (Catch_ $catch) {
            return $catch->var;
        },$catches);

        return $variables;
    }
}

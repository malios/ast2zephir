<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Interface_ extends Generator
{
    use ParseStatements;

    private $template = <<<'EOT'
interface %s%s
{
%s
}
EOT;


    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::INTERFACE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Interface_ $node
     */
    protected function doGenerateCode($node): string
    {
        $extends = $this->getExtends($node);
        $stmts = $this->parseStatements($this->finder, ...$node->stmts);
        if (!empty($stmts)) {
            $stmts = $this->indent($stmts);
        }

        $code = sprintf($this->template, $node->name, $extends, $stmts);
        return $code;
    }

    private function getExtends(Node\Stmt\Interface_ $node): string
    {
        $code = '';
        if (!empty($node->extends)) {
            $extends = array_map(function ($node) {
                return join('//', $node->parts);
            }, $node->extends);

            $code .= ' extends ' . join(', ', $extends);
        }

        return $code;
    }
}

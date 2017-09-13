<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class Echo_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::ECHO;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Echo_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expressions = array_map(function (Node $e) {
            $generator = $this->finder->find($e->getType());
            return $generator->generateCode($e);
        }, $node->exprs);

        return 'echo ' . join(', ', $expressions);
    }
}

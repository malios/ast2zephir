<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Use_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::USE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Use_ $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        $uses = $node->uses;
        foreach ($uses as $use) {
            $next = $this->finder->find($use->getType());
            $code .= 'use ' . $next->generateCode($use) . ';';
        }

        return $code;
    }
}

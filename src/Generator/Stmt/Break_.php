<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class Break_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::BREAK;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Break_ $node
     */
    protected function doGenerateCode($node): string
    {
        // todo: support for break argument. e.g. break 2; - breaks 2 nested loops
        return 'break';
    }
}

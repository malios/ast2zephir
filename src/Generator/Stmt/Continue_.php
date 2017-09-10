<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Continue_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::CONTINUE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Continue_ $node
     */
    protected function doGenerateCode($node): string
    {
        // todo: execute post conditions in for loop
        // todo: support for continue argument. e.g. continue 2; - continues outer loop
        return 'continue';
    }
}

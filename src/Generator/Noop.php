<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use PhpParser\Node;

final class Noop extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Scalar $node
     */
    protected function doGenerateCode($node): string
    {
        return '';
    }
}

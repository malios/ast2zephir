<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Scalar;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Scalar;
use PhpParser\Node;

final class LNumber extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Scalar::LNUMBER;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Scalar\LNumber $node
     */
    protected function doGenerateCode($node): string
    {
        return (string) $node->value;
    }
}
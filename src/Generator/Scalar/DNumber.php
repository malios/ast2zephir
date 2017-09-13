<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Scalar;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Scalar;
use PhpParser\Node;

final class DNumber extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Scalar::DNUMBER;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Scalar\DNumber $node
     */
    protected function doGenerateCode($node): string
    {
        return (string) $node->value;
    }
}

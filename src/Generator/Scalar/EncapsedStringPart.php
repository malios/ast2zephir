<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Scalar;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Scalar;
use PhpParser\Node;

final class EncapsedStringPart extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Scalar::ENCAPSED_STRING_PART;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Scalar\EncapsedStringPart $node
     */
    protected function doGenerateCode($node): string
    {
        $value = json_encode($node->value);
        return $value;
    }
}

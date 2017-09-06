<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Name as NameEnum;
use PhpParser\Node;

final class FullyQualified extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === NameEnum::FULLY_QUALIFIED;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Name\FullyQualified $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '\\' . join('\\', $node->parts);
        return $code;
    }
}

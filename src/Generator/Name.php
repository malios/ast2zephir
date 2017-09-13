<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Enum\Name as NameEnum;
use PhpParser\Node;

final class Name extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === NameEnum::NAME;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Name $node
     */
    protected function doGenerateCode($node): string
    {
        $code = join('\\', $node->parts);
        return $code;
    }
}

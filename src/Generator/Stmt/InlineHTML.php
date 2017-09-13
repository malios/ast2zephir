<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class InlineHTML extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::INLINE_HTML;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\InlineHTML $node
     */
    protected function doGenerateCode($node): string
    {
        $parts = explode(PHP_EOL, $node->value);
        $code = 'echo "' . join('" . PHP_EOL . "', $parts) . '"';
        return $code;
    }
}

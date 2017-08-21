<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class UseUse extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::USE_USE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\UseUse $node
     */
    protected function doGenerateCode($node): string
    {
        $parts = $node->name->parts;
        $result = join('\\', $parts);
        // alias is used
        if ($node->alias !== $parts[count($parts) - 1]) {
            $result .= ' as ' . $node->alias;
        }

        return $result;
    }
}

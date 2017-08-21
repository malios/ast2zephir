<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class PropertyProperty extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::PROPERTY_PROPERTY;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\PropertyProperty $node
     */
    protected function doGenerateCode($node): string
    {
        $code = $node->name;
        if ($node->default !== null) {
            $next = $this->finder->find($node->default->getType());
            $code .= ' = ' . $next->generateCode($node->default);
        }

        return $code;
    }
}

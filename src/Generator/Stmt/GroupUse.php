<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class GroupUse extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::GROUP_USE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\GroupUse $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        $prefix = join('\\', $node->prefix->parts) . '\\';
        foreach ($node->uses as $index => $use) {
            $next = $this->finder->find($use->getType());
            $code .= 'use ' . $prefix . $next->generateCode($use) . ';';
            if ($index !== (count($node->uses) - 1)) {
                $code .= PHP_EOL;
            }
        }
        return $code;
    }
}

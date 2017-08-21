<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class ClassConst extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::CLASS_CONST;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\ClassConst $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        $last = count($node->consts) - 1;
        foreach ($node->consts as $index => $const) {
            $constgen = $this->finder->find($const->getType());
            $code .= $constgen->generateCode($const). ';';
            if ($index !== $last) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }
}

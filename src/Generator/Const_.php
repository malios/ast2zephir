<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use PhpParser\Node;

final class Const_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === 'Const';
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Const_ $node
     */
    protected function doGenerateCode($node): string
    {
        $next = $this->finder->find($node->value->getType());
        $code = 'const ' . $node->name . ' = ' . $next->generateCode($node->value);
        return $code;
    }
}

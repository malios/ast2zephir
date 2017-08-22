<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use PhpParser\Node;

final class Param extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === 'Param';
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Param $node
     */
    protected function doGenerateCode($node): string
    {
        if ($node->byRef) {
            $this->logger->notice('Pass by reference is not supported in Zephir', ['node' => $node]);
        }

        $code = '';
        if ($node->type !== null) {
            $code .= $node->type . ' ';
        }

        $code .= $node->name;
        if ($node->default !== null) {
            $next = $this->finder->find($node->default->getType());
            $code .= ' = ' . $next->generateCode($node->default);
        }

        return $code;
    }
}

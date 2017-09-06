<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Scalar;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Scalar;
use PhpParser\Node;

final class Encapsed extends Generator
{
    use NodeToCode;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Scalar::ENCAPSED;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param \PhpParser\Node\Scalar\Encapsed $node
     */
    protected function doGenerateCode($node): string
    {
        $parts = array_map(function (Node $part) {
            return $this->nodeToCode($part, $this->finder);
        }, $node->parts);

        dump($parts);
        $code = join('. ', $parts);
        return $code;
    }
}

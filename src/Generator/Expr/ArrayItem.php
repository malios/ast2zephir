<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class ArrayItem extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::ARRAY_ITEM;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\ArrayItem $item
     */
    protected function doGenerateCode($item): string
    {
        $code = '';
        if ($item->key !== null) {
            $keygen = $this->finder->find($item->key->getType());
            $code .= $keygen->generateCode($item->key) . ': ';
        }

        $valgen = $this->finder->find($item->value->getType());
        $code .= $valgen->generateCode($item->value);
        return $code;
    }
}

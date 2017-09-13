<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;
use PhpParser\Node\Expr\Array_ as ExprArray;

final class Array_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::ARRAY;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprArray $array
     */
    protected function doGenerateCode($array): string
    {
        $code = '[';
        if (count($array->items) > 0) {
            $code .= PHP_EOL;
            $last = count($array->items) - 1;
            foreach ($array->items as $index => $item) {
                $itemGenerator = $this->finder->find($item->getType());
                $code .= $this->indent($itemGenerator->generateCode($item));
                if ($index !== $last) {
                    $code .= ',';
                }

                $code .= PHP_EOL;
            }
        }

        $code .= ']';
        return $code;
    }
}

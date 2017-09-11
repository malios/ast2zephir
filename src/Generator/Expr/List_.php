<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class List_ extends Generator
{
    const UNIQUE_ID = '59b68bd3dd2ca';

    use NodeToCode;

    private $template = 'let %s = %s';

    /**
     * @var Node
     */
    private $listArrayExpression = null;

    public function setListArrayExpression(Node $arr)
    {
        $this->listArrayExpression = $arr;
    }

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::LIST;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\List_ $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        $expr = $this->nodeToCode($this->listArrayExpression, $this->finder);
        if ($this->listArrayExpression->getType() === Expr::VARIABLE) {
            $right = $expr;
        } else {
            $tmpArray = 'tmpArray' . self::UNIQUE_ID;
            $code .= "var $tmpArray;" . PHP_EOL
                . "let $tmpArray = $expr;" . PHP_EOL;
            $right = $tmpArray;
        }

        $lines = array_map(function (Node\Expr\ArrayItem $item, $index) use ($right) {
            $left = $this->nodeToCode($item, $this->finder);
            $right = $right . '[' . (string) $index . ']';

            $line = sprintf($this->template, $left, $right);
            return $line;
        }, $node->items, array_keys($node->items));

        $code .= join(';' . PHP_EOL, $lines);
        return $code;
    }
}

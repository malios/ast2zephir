<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Throw_ extends Generator
{
    use NodeToCode;

    private $template = 'throw %s';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::THROW;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Throw_ $node
     */
    protected function doGenerateCode($node): string
    {
        $expression = $this->nodeToCode($node->expr, $this->finder);
        $code = sprintf($this->template, $expression);
        return $code;
    }
}

<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\Arguments;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class New_ extends Generator
{
    use NodeToCode;
    use Arguments;

    private $template = '%snew %s(%s)';

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::NEW;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\New_ $node
     */
    protected function doGenerateCode($node): string
    {
        $assignCode = $this->getAssignCode($node, $this->finder);
        $arguments = $this->getArguments($node, $this->finder);
        $argumentsCode = join(', ', $arguments);

        $class = $this->nodeToCode($node->class, $this->finder);
        if ($node->class->getType() === Expr::VARIABLE) {
            $class = '{' . $class . '}';
        }

        $code = sprintf($this->template, $assignCode . '%s', $class, $argumentsCode);
        return $code;
    }
}

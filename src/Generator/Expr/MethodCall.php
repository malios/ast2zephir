<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\Arguments;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Generator;
use PhpParser\Node;

final class MethodCall extends Generator
{
    use NodeToCode;
    use Arguments;

    private $template = <<<'EOT'
%s%s%s(%s)
EOT;


    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Expr::METHOD_CALL;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Expr\MethodCall $node
     */
    protected function doGenerateCode($node): string
    {
        $assignCode = $this->getAssignCode($node, $this->finder);
        $accessor = $this->nodeToCode($node->var, $this->finder) . '->';
        $arguments = $this->getArguments($node, $this->finder);
        $argumentsCode = join(', ', $arguments);

        $code = sprintf($this->template, $assignCode . '%s', $accessor, $node->name, $argumentsCode);
        return $code;
    }
}

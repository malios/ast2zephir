<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use PhpParser\Node;

final class Param extends Generator
{
    use NodeToCode;

    private $template = '%s %s %s'; // e.g function test(int a = 0) {}

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

        $left = $this->getTypeString($node);
        $right = '';
        if ($node->default !== null) {
            $default = $this->nodeToCode($node->default, $this->finder);
            $right = '= ' . $default;
        }

        $code = sprintf($this->template, $left, $node->name, $right);
        return trim($code);
    }

    private function getTypeString(Node\Param $node): string
    {
        if ($node->type === null) {
            return '';
        }

        if ($node->type instanceof Node) {
            $type = '<' . $this->nodeToCode($node->type, $this->finder) . '>';
            return $type;
        }

        return $node->type;
    }
}

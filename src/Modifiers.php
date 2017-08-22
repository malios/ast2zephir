<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

use PhpParser\Node;

trait Modifiers
{
    /**
     * Get modifiers of a node of type Class, ClassMethod etc.
     *
     * @param Node $node
     * @return string
     */
    private function getModifiers(Node $node): string
    {
        $allModifiers = ['public', 'protected', 'private', 'static', 'abstract', 'final'];
        $modifiers = '';
        foreach ($allModifiers as $modifier) {
            $method = 'is' . ucfirst($modifier);
            if (method_exists($node, $method) && call_user_func_array([$node, $method], [])) {
                $modifiers .= $modifier . ' ';
            }
        }

        return rtrim($modifiers);
    }
}

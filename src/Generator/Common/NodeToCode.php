<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Common;

use Malios\Ast2Zephir\Generator\Finder;
use PhpParser\Node;

trait NodeToCode
{
    private function nodeToCode(Node $node, Finder $finder)
    {
        $generator = $finder->find($node->getType());
        $code = $generator->generateCode($node);
        return $code;
    }
}

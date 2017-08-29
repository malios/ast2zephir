<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Common;

use PhpParser\Node\FunctionLike;

trait ReturnType
{
    private function getReturnTypeDeclaration(FunctionLike $node): string
    {
        $returnType = $node->getReturnType();
        if ($returnType === null) {
            return '';
        }

        if (is_string($returnType)) {
            return '-> ' . $returnType;
        }

        return '-> <' . join('\\', $returnType->parts) . '>';
    }
}

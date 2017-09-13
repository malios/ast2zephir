<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Enum\Stmt;
use PhpParser\Node;

final class Property extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::PROPERTY;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Property $node
     */
    protected function doGenerateCode($node): string
    {
        $code = '';
        $modifier = $this->getModifier($node);
        $generator = $this->finder->find(Stmt::PROPERTY_PROPERTY);
        $last = count($node->props) - 1;
        foreach ($node->props as $index => $propertyProperty) {
            $code .= $modifier . ' ' . $generator->generateCode($propertyProperty) . ';';
            if ($index !== $last) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }

    private function getModifier(Node\Stmt\Property $property): string
    {
        $visibility = '';
        if ($property->isPublic()) {
            $visibility = 'public';
        }

        if ($property->isProtected()) {
            $visibility = 'protected';
        }

        if ($property->isPrivate()) {
            $visibility = 'private';
        }

        return $visibility . ($property->isStatic() ? ' static' : '');
    }
}

<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Class_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::CLASS_;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Class_ $node
     */
    protected function doGenerateCode($node): string
    {
        $code = ltrim($this->getModifier($node) . ' class ' . $node->name);
        if ($node->extends !== null) {
            $code .= ' extends ' . join('\\', $node->extends->parts);
        }

        if (!empty($node->implements)) {
            $interfaces = array_map(function (Node\Name $name) {
                return join('\\', $name->parts);
            }, $node->implements);

            $code .= ' implements ' . join(', ', $interfaces);
        }

        $code .= PHP_EOL . '{' . PHP_EOL;
        if (!empty($node->stmts)) {
            $stmtsBlock = $this->parseStatements(...$node->stmts) . PHP_EOL;
            $code .= $this->indent($stmtsBlock);
        }

        return $code . '}';
    }

    private function getModifier(Node\Stmt\Class_ $class): string
    {
        if ($class->isAbstract()) {
            return 'abstract';
        }

        if ($class->isFinal()) {
            return 'final';
        }

        return '';
    }

    private function parseStatements(Node ...$stmts): string
    {
        $code = '';
        foreach ($stmts as $index => $stmt) {
            $generator = $this->finder->find($stmt->getType());
            $code .= $generator->generateCode($stmt);
            if ($index !== (count($stmts) - 1)) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }
}
